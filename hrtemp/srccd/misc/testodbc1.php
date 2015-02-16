<?
// connect to DSN MSSQL with a user and password
$connect = odbc_connect("linuxtosql", "hrexpress", "P0lyc0m1") or die
  ("couldn't connect");
odbc_exec($connect, "employees") or die("could not connect in the last attempt".odbc_get_last_message());
$result = odbc_exec($connect, "SELECT * " .
        "FROM dbo.vp");
while(odbc_fetch_row($result)){
  print(odbc_result($result, "name") . "<br>\n");
}
odbc_free_result($result);
odbc_close($connect);
?>