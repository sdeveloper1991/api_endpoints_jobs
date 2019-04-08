# wait-for-if.sh
echo "After the container mysql and the composer installed all components is runing we migrate the database"

# we check if the autoload.php is created , then all our package php is installed
while [ ! -f /var/www/jobs/vendor/autoload.php ]
 do
    sleep 1
done

echo "$(date) - migration set-u successfully"
php bin/console doctrine:migrations:migrate 
php bin/console doctrine:fixtures:load
php bin/console doctrine:database:create --env=test
php bin/console cache:clear --env=prod

exit 1;





