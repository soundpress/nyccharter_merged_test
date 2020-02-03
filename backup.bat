@Echo off
SET WORKDIR=%~dp0
SET SCRIPTNAME=backup
SET LOGFILE=%WORKDIR%/srv/%SCRIPTNAME%.log
call :Logit
exit /b 0
pause

:Logit
cd %WORKDIR%
c:\OSpanel\modules\php\PHP_7.1-x64\php.exe -f %SCRIPTNAME%.php