#!/bin/bash
read -r -p "Copy from /var/www/joomlatest? [enter/anything else]" response
response=${response,,}
if [[ $response =~ ^(yes|y| ) ]] | [ -z $response ]; then
  echo "Performing rsync"
  rsync -avz  "/var/www/joomlatest/components/com_registration/" "com_registration/site/"
  rsync -avz  "/var/www/joomlatest/administrator/components/com_registration/" "com_registration/admin/"
  sleep 5
fi
echo "Start compiling component to zipped package"

zip -r com_registration.zip com_registration
mv com_registration.zip pkg_registration/packages
zip -r pkg_registration.zip pkg_registration
echo "Finished. You can now install pkg_registration.zip"
