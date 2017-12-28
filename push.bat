@echo off

cd ..\..\Desktop\milyoncu
git add -A .

set /p str="Commit mesajiniz  : "
git commit -m "%str%"

git push
pause