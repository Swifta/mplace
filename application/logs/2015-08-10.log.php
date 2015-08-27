<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-08-10 12:50:41 +05:30 --- error: Uncaught PHP Error: SoapClient::SoapClient(http://www.webservicex.com/globalweather.asm?wsdl): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
 in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 21
2015-08-10 12:50:42 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:50:42 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:50:42 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:50:42 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:52:31 +05:30 --- error: Uncaught PHP Error: simplexml_load_string(): Entity: line 1: parser error : Start tag expected, '&lt;' not found in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 61
2015-08-10 12:53:00 +05:30 --- error: Uncaught SoapFault: System.Web.Services.Protocols.SoapException: Server was unable to process request. ---> System.Data.SqlClient.SqlException: Procedure or function 'getWeather' expects parameter '@CityName', which was not supplied.
   at System.Data.SqlClient.SqlConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.SqlInternalConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.TdsParser.ThrowExceptionAndWarning(TdsParserStateObject stateObj, Boolean callerHasConnectionLock, Boolean asyncClose)
   at System.Data.SqlClient.TdsParser.TryRun(RunBehavior runBehavior, SqlCommand cmdHandler, SqlDataReader dataStream, BulkCopySimpleResultSet bulkCopyHandler, TdsParserStateObject stateObj, Boolean& dataReady)
   at System.Data.SqlClient.SqlCommand.FinishExecuteReader(SqlDataReader ds, RunBehavior runBehavior, String resetOptionsString)
   at System.Data.SqlClient.SqlCommand.RunExecuteReaderTds(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, Boolean async, Int32 timeout, Task& task, Boolean asyncWrite, SqlDataReader ds)
   at System.Data.SqlClient.SqlCommand.RunExecuteReader(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, String method, TaskCompletionSource`1 completion, Int32 timeout, Task& task, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.InternalExecuteNonQuery(TaskCompletionSource`1 completion, String methodName, Boolean sendToPipe, Int32 timeout, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.ExecuteNonQuery()
   at WebServicex.GlobalWeather.GetWeather(String CityName, String CountryName)
   --- End of inner exception stack trace --- in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 29
2015-08-10 12:53:59 +05:30 --- error: Uncaught SoapFault: System.Web.Services.Protocols.SoapException: Server was unable to process request. ---> System.Data.SqlClient.SqlException: Procedure or function 'getWeather' expects parameter '@CityName', which was not supplied.
   at System.Data.SqlClient.SqlConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.SqlInternalConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.TdsParser.ThrowExceptionAndWarning(TdsParserStateObject stateObj, Boolean callerHasConnectionLock, Boolean asyncClose)
   at System.Data.SqlClient.TdsParser.TryRun(RunBehavior runBehavior, SqlCommand cmdHandler, SqlDataReader dataStream, BulkCopySimpleResultSet bulkCopyHandler, TdsParserStateObject stateObj, Boolean& dataReady)
   at System.Data.SqlClient.SqlCommand.FinishExecuteReader(SqlDataReader ds, RunBehavior runBehavior, String resetOptionsString)
   at System.Data.SqlClient.SqlCommand.RunExecuteReaderTds(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, Boolean async, Int32 timeout, Task& task, Boolean asyncWrite, SqlDataReader ds)
   at System.Data.SqlClient.SqlCommand.RunExecuteReader(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, String method, TaskCompletionSource`1 completion, Int32 timeout, Task& task, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.InternalExecuteNonQuery(TaskCompletionSource`1 completion, String methodName, Boolean sendToPipe, Int32 timeout, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.ExecuteNonQuery()
   at WebServicex.GlobalWeather.GetWeather(String CityName, String CountryName)
   --- End of inner exception stack trace --- in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 29
2015-08-10 12:53:59 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:55:39 +05:30 --- error: Uncaught SoapFault: System.Web.Services.Protocols.SoapException: Server was unable to process request. ---> System.Data.SqlClient.SqlException: Procedure or function 'getWeather' expects parameter '@CityName', which was not supplied.
   at System.Data.SqlClient.SqlConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.SqlInternalConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.TdsParser.ThrowExceptionAndWarning(TdsParserStateObject stateObj, Boolean callerHasConnectionLock, Boolean asyncClose)
   at System.Data.SqlClient.TdsParser.TryRun(RunBehavior runBehavior, SqlCommand cmdHandler, SqlDataReader dataStream, BulkCopySimpleResultSet bulkCopyHandler, TdsParserStateObject stateObj, Boolean& dataReady)
   at System.Data.SqlClient.SqlCommand.FinishExecuteReader(SqlDataReader ds, RunBehavior runBehavior, String resetOptionsString)
   at System.Data.SqlClient.SqlCommand.RunExecuteReaderTds(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, Boolean async, Int32 timeout, Task& task, Boolean asyncWrite, SqlDataReader ds)
   at System.Data.SqlClient.SqlCommand.RunExecuteReader(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, String method, TaskCompletionSource`1 completion, Int32 timeout, Task& task, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.InternalExecuteNonQuery(TaskCompletionSource`1 completion, String methodName, Boolean sendToPipe, Int32 timeout, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.ExecuteNonQuery()
   at WebServicex.GlobalWeather.GetWeather(String CityName, String CountryName)
   --- End of inner exception stack trace --- in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 29
2015-08-10 12:55:39 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:57:34 +05:30 --- error: Uncaught SoapFault: System.Web.Services.Protocols.SoapException: Server was unable to process request. ---> System.Data.SqlClient.SqlException: Procedure or function 'getWeather' expects parameter '@CityName', which was not supplied.
   at System.Data.SqlClient.SqlConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.SqlInternalConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.TdsParser.ThrowExceptionAndWarning(TdsParserStateObject stateObj, Boolean callerHasConnectionLock, Boolean asyncClose)
   at System.Data.SqlClient.TdsParser.TryRun(RunBehavior runBehavior, SqlCommand cmdHandler, SqlDataReader dataStream, BulkCopySimpleResultSet bulkCopyHandler, TdsParserStateObject stateObj, Boolean& dataReady)
   at System.Data.SqlClient.SqlCommand.FinishExecuteReader(SqlDataReader ds, RunBehavior runBehavior, String resetOptionsString)
   at System.Data.SqlClient.SqlCommand.RunExecuteReaderTds(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, Boolean async, Int32 timeout, Task& task, Boolean asyncWrite, SqlDataReader ds)
   at System.Data.SqlClient.SqlCommand.RunExecuteReader(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, String method, TaskCompletionSource`1 completion, Int32 timeout, Task& task, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.InternalExecuteNonQuery(TaskCompletionSource`1 completion, String methodName, Boolean sendToPipe, Int32 timeout, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.ExecuteNonQuery()
   at WebServicex.GlobalWeather.GetWeather(String CityName, String CountryName)
   --- End of inner exception stack trace --- in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 29
2015-08-10 12:57:34 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 12:59:46 +05:30 --- error: Uncaught SoapFault: System.Web.Services.Protocols.SoapException: Server was unable to process request. ---> System.Data.SqlClient.SqlException: Procedure or function 'getWeather' expects parameter '@CityName', which was not supplied.
   at System.Data.SqlClient.SqlConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.SqlInternalConnection.OnError(SqlException exception, Boolean breakConnection, Action`1 wrapCloseInAction)
   at System.Data.SqlClient.TdsParser.ThrowExceptionAndWarning(TdsParserStateObject stateObj, Boolean callerHasConnectionLock, Boolean asyncClose)
   at System.Data.SqlClient.TdsParser.TryRun(RunBehavior runBehavior, SqlCommand cmdHandler, SqlDataReader dataStream, BulkCopySimpleResultSet bulkCopyHandler, TdsParserStateObject stateObj, Boolean& dataReady)
   at System.Data.SqlClient.SqlCommand.FinishExecuteReader(SqlDataReader ds, RunBehavior runBehavior, String resetOptionsString)
   at System.Data.SqlClient.SqlCommand.RunExecuteReaderTds(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, Boolean async, Int32 timeout, Task& task, Boolean asyncWrite, SqlDataReader ds)
   at System.Data.SqlClient.SqlCommand.RunExecuteReader(CommandBehavior cmdBehavior, RunBehavior runBehavior, Boolean returnStream, String method, TaskCompletionSource`1 completion, Int32 timeout, Task& task, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.InternalExecuteNonQuery(TaskCompletionSource`1 completion, String methodName, Boolean sendToPipe, Int32 timeout, Boolean asyncWrite)
   at System.Data.SqlClient.SqlCommand.ExecuteNonQuery()
   at WebServicex.GlobalWeather.GetWeather(String CityName, String CountryName)
   --- End of inner exception stack trace --- in file A:/C_CLONE/wamp/www/ecommerce/application/controllers/home.php on line 29
2015-08-10 12:59:46 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 15:30:05 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 15:30:05 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 15:30:05 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 15:30:05 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 15:35:06 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:28:53 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:29:45 +05:30 --- error: Uncaught PHP Error: mysql_real_escape_string(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead in file A:/C_CLONE/wamp/www/ecommerce/modules/merchant/models/merchant.php on line 613
2015-08-10 16:29:45 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:35:33 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:37:28 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:39:16 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:40:41 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:40:42 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:40:53 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:40:54 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:42:50 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:44:28 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:44:39 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:44:39 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:47:27 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:48:20 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:48:20 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:48:20 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:48:20 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:48:21 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:18 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:49:18 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:49:32 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:32 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:49:36 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:54:53 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:54:53 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:59:29 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 16:59:14 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:59:14 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:59:15 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:59:15 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:59:15 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 16:59:15 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:03 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:05:26 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:04:50 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:04:50 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:04:51 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:04:51 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:04:51 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:04:51 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:16 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:16 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:16 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:17 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:17 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:05:18 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:06:07 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:06:12 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:06:13 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:07:41 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:07:26 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:26 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:26 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:27 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:27 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:27 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:28 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:40 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:07:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:35 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:35 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:36 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:07:36 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:09:09 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:09:10 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:08:32 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:32 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:32 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:33 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:33 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:33 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:08:34 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:32 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:10:33 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:10:21 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:21 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:22 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:22 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:23 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:23 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:10:26 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:37 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:11:23 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:23 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:24 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:24 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:24 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:25 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:11:31 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:47 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:16:47 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 17:16:39 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:39 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:39 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:39 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:39 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:40 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:16:41 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:09 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:09 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:09 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:10 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:11 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:24:11 +05:30 --- error: Uncaught PHP Error: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. in file A:/C_CLONE/wamp/www/ecommerce/modules/home/models/home.php on line 1154
2015-08-10 17:31:01 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
2015-08-10 18:12:41 +05:30 --- error: Uncaught Kohana_Exception: The requested view, _error/404, could not be found in file A:/C_CLONE/wamp/www/ecommerce/system/core/Kohana.php on line 1162
