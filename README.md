# SETUP LOCALLY
- Run joomla locally e.g on Apache
- install package via zip
This script will sync /var/www/joomlatest/administrator/components/com_registration/ with the package files. And rezip it again, so you can distribute the new, fixed package zip file.

# DEVELOPMENT

- develop package on installed joomla
- when you want to merge changes from installed joomla to the package do:
`git clone git@github.com:blaszczakphoto/zapisy_online.git`
`cd zapisy_online`
and run script:
`./COMPILE.sh`