git fetch --all
git reset --hard origin/master
find www/ -type d -exec chmod 755 {} \;
find www/ -type f -exec chmod 644 {} \;
