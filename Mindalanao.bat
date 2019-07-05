@echo off
TITLE APPLICATION OPENER
ECHO Application Process Initiated
START http://localhost:8000
ECHO Starting Server...
call php artisan serve
@PAUSE