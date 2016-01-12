<?

/*
 * Class SmushIt
 *  Compresses images for you using the Yahoo Smush it page
 *  http://www.smush.it/
 *
 * Author:
 *  Frank Broersen
 *  www.pitgroup.nl
 *
 * Usage:
 *  $smush = new SmushIt;
 *  $smush->base = 'http://www.yourdomain.com'; // ( Must be accessible for the Smush It api )
 *  if( !$smush->smush('assets/img/unsmushed/h-jacobusparochie-noordwest-friesland.png','assets/smushed/h-jacobusparochie-noordwest-friesland.png') ) {
 *    echo $smush->msg;
 *  } else {
 *    echo 'saved: ' . $smush->savings . 'kb (' . $smush->savings_perc . '%)';
 *  }
 */
class SmushIt {

  private $src_image;

  private $res_image;

  private $smush_url;

  private $msg;

  private $base;

  private $savings;

  private $savings_perc;

  public function __construct(){

    $this->src_image = '';

    $this->res_image = '';

    $this->smush_url = 'http://www.smushit.com/ysmush.it/ws.php?img=';

    $this->base = '';

    $this->msg = '';

    $this->savings = 0;

    $this->savings_perc = 0;

  }

  /**
   * smush
   * Smushes an image
   * @param string $src_image the directory and filename of the source image
   * @param string $res_image the directory and filename of the result image
   * @return bool
   */
  public function smush( $src_image = '', $res_image = '' ) {

    /**
     * Data Checks for input and used methods
     */
    if( $src_image != '' ) {
      $this->src_image = $src_image;
    }
    if( $this->src_image == '' ) {
      $this->msg = 'The source image cannot be empty.';
      return false;
    }

    if( $res_image != '' ) {
      $this->res_image = $res_image;
    }
    $this->res_image = $res_image;
    if( $this->res_image == '' ) {
      $this->msg = 'The result image cannot be empty.';
      return false;
    }

    if( !function_exists('json_decode') ) {
      $this->msg = 'Json is not supported.';
      return false;
    }

    if( !function_exists('curl_init') ) {
      $this->msg = 'Curl is not supported.';
      return false;
    }

    if( !file_exists( $_SERVER['DOCUMENT_ROOT'] . $src_image ) ) {
      $this->msg = 'The source file does not exists.';
      return false;
    }

    /**
     * Open the Smush.it url with the input images and save the result into $result
     */
    $url = $this->smush_url . $this->base . $this->src_image;
    echo $url;
    die();
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec ($ch);
    curl_close ($ch);

    if( $result == '' ) {
      $this->msg = 'An unknown error occured, check the smushit web page.';
      return false;
    }

    /**
     * Parse $result into an object
     */
    $data = json_decode( $result );

    /**
     * If the error var isset, return false/
     */
    if( isset( $data->error ) ) {
      $this->msg = 'Image cannot be smushed.';
      return false;
    }

    if( $data->dest_size < $data->src_size ) {

      $this->savings = $data->src_size - $data->dest_size;

      $this->savings_perc = $data->percent;

      $ch = curl_init();
      curl_setopt ($ch, CURLOPT_URL, $data->dest);
      curl_setopt ($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $image = curl_exec ($ch);
      curl_close ($ch);

      $fh = @fopen($this->res_image, 'w');
      @fwrite($fh, $image);
      @fclose($fh);

      $this->msg = 'The image has been smushed.';
      return true;
    }

    $this->msg = 'No savings could be made.';
    return true;

  }

  /**
   * Setter
   * @param string $var
   * @param <type> $value
   */
  public function __set( $var, $value = '' ) {
    switch( $var ) {

      case 'base':
        $this->base = $value;
        break;

      case 'savings':
        $this->savings = $value;
        break;

      case 'savings_perc':
        $this->savings_perc = $value;
        break;

      case 'msg':
        $this->msg = $value;
        break;

      /*
       * Easy source setting
       */
      case 'src_image':
      case 'source':
      case 'src':
        $this->src_image = $value;
        break;

      /*
       * Easy result setting
       */
      case 'res_image':
      case 'result':
      case 'res':
        $this->res_image = $value;
        break;

      default:
        throw new Exception("You are trying to set an unknown or private variable: " . $var);
        break;
    }
  }

  /**
   * Getter
   * @param string $var
   * @return <type>
   */
  public function __get( $var ) {
    switch( $var ) {

      case 'url':
        return $this->url;
        break;

      case 'savings':
        return $this->savings;
        break;

      case 'savings_perc':
        return $this->savings_perc;
        break;

      case 'base':
        return $this->base;
        break;

      case 'msg':
        return $this->msg;
        break;

      /*
       * Easy source setting
       */
      case 'src_image':
      case 'source':
      case 'src':
        return $this->src_image;
        break;

      /*
       * Easy result setting
       */
      case 'res_image':
      case 'result':
      case 'res':
        return $this->res_image;
        break;

      default:
        throw new Exception("You are trying to get an unknown variable: " . $var);
        break;
    }
  }

}