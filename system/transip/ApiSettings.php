<?php

/**
 * This class holds the settings for the TransIP API.
 * 
 * @package Transip
 * @class ApiSettings
 * @author TransIP (support@transip.nl)
 */
class Transip_ApiSettings
{
	/**
	 * The mode in which the API operates, can be either:
	 *		readonly
	 *		readwrite
	 *
	 * In readonly mode, no modifying functions can be called.
	 * To make persistent changes, readwrite mode should be enabled.
	 */
	public static $mode = 'readonly';

	 /**
	 * TransIP API endpoint to connect to.
	 *
	 * e.g.:
	 *
	 * 		'api.transip.nl'
	 * 		'api.transip.be'
	 * 		'api.transip.eu'
	 */
	public static $endpoint = 'api.transip.nl';

	/**
	 * Your login name on the TransIP website.
	 *
	 */
	public static $login = 'gertlily';

	/**
	 * One of your private keys; these can be requested via your Controlpanel
	 */
	public static $privateKey = '-----BEGIN PRIVATE KEY-----
MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDOZ6xUXYVAR4oD
yMjC85kPElrIHfcpE+5zTtDurw2caTlb7H00SrUGTAUyKKu3RkVlqlk5fpNvsOq/
jz1WzeR513Ivx5Kaf8/jbbSqIdvadPLdu4CqLF7qxGo4USXy36OOQUvp2/+gnuiG
Ii3M1lz35WXbCE2iK90JkvSIwJVNMDeKg0bAxOBmXpYJHgQPaSQy567+4tIL1Ge7
mFjAVcQKX+IuALXV8zLa5MXqlTYCQwRBYu30JkirdGniMMAErw7YoXMJCGnSeSq0
QseFnvNEn/VKIWywME+6xccYaZ7QwmEtIbnrTqof/e8ssaejeI/ZKB5o89LAaIfv
LYrAv11BAgMBAAECggEBAIZrDdeDcBwEeuUsBVKwwaUHFwfsO+IMkOWXFonahsqt
3CT5RjCf1nRbXabkxa99nAQxhBnlTK8YUEigSBoXzAttO3fSSK9FPWWnNFj34+3I
68FrMsegTdAmSeaTMluROTqTW5TZKQi5dESmTZ1wnOr0Afk61xQd7L0nbwkAIjs5
WAS4OtD+aBmp+VDn5OeGE6oXbyrF9HB1VrmhOUy2L5hVRTHGUfMj/ZXO7sTpvkGB
wfDzTbqGzsNRxvS7MEMtLhZuPNItLcyfpwbWsgVUHwXu8dlja0w9EeGKkKh1hofd
Sy6SL6gU3QPW5JYIYXPwLqSq57/ZQDQG/b6KqvauMoECgYEA6PLtEfbFsu1X/+kM
/QICByhf1u/XqTwkYdDyTXcz8I4+TuSP0hixYvi9T2+9+8mFG5u19EPX64Kg7LSo
Ebs/++v98QCNKKpnnwRnQi4uQHTvdjbxfaL8wDt2rstREBGx6Xl0+/j0/ArROW/5
AzVpfzi0nijqoULDTioCo0UoGsUCgYEA4tRVkryBc0pfMmUoXIRjQWmqk9vcYPaX
v2KD9QhzkRUgS2k75E5sj/Tjoe5is2mK4UoKdUNaWjg54BV7BerSop4oQ1BybOh0
qSimQJpXrBTAhlGVibWUHh33/SvmtQ3VMBXFm90dI+3+1Wz9BiZDcveI4DQhL33j
4ioT3MYnEE0CgYEAh7dwUzT4fYQ17syyWn1e/RiSrcDSXrDBaZO4d1Vpl07oEkKr
X/Yu8sCEWtF5WEZSHIGdgpA8LePPKdkeyiXT40vciRqPIxAUitqf5jjNjZQTJ0Zf
b5kTtFNwk+m0cq48fw/aDis/X9BVkSchZrMpoYtB/5tLB2TEMLfdDY5vDRkCgYAy
a9C51X1RC28t3J6kMil+GOb6Bx1t0GLbACMlDMPjtDaBjNrrXSN0vJL9I+h8yTE9
8x9wAZDMDUOQNDYsko5P56g7jl5hJysHjymloqlqbxJ8yRXcjqhmKXM+q8uU44ZI
Mg7DHtujaPwEpT15aHgFzlB2xh+6VtmZJJFVuhZk4QKBgQC1jMKGmyFVGfIddxjQ
h6o8aqRktFwaW0g0za4uNQGE0MemUmPRn0XkMQKSsNECWbGxXY7mciglDgQ3XJjE
DLOe8gDV1cvsXAgv+PP+SPfvH3MBq4M97TvWAV/DOIOExq0PqwKRxAZfhRhk1y9D
03VuIn6le03UuqFp+YOtDU6UoQ==
-----END PRIVATE KEY-----';
}