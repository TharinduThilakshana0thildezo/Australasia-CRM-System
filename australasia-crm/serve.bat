@echo off
REM ============================================================
REM  Australasia CRM - Dev Server Launcher
REM  Uses the local php.ini so pdo_sqlite / sqlite3 are enabled
REM ============================================================
php -c "%~dp0php.ini" artisan serve %*

