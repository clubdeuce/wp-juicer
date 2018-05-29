#!/usr/bin/env bash


svn checkout http://develop.svn.wordpress.org/tags/${WP_VERSION} ${WP_TESTS_DIR}
mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
echo "GRANT ALL ON ${DB_NAME}.* TO '${DB_USER}'@'%' IDENTIFIED BY '${DB_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'%' IDENTIFIED BY ${DB_PASS};"
cp ${WP_TESTS_DIR}/wp-tests-config-sample.php ${WP_TESTS_DIR}/wp-tests-config.php
sed -i 's/youremptytestdbnamehere/'${DB_NAME}'/' ${WP_TESTS_DIR}/wp-tests-config.php
sed -i 's/yourusernamehere/'${DB_USER}'/' ${WP_TESTS_DIR}/wp-tests-config.php
sed -i 's/yourpasswordhere/'${DB_PASS}'/' ${WP_TESTS_DIR}/wp-tests-config.php
sed -i 's/localhost/'${DB_HOST}'/' ${WP_TESTS_DIR}/wp-tests-config.php
./vendor/bin/phpunit -c ${TESTS_DIR}/phpunit.xml.dist