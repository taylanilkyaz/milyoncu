@echo off

cd ..\..\Desktop\milyoncu
git add -A .
git reset -- .idea/*
git reset -- .idea

set /p str="Commit mesajiniz  : "
git commit -m "%str%"

git push
pause