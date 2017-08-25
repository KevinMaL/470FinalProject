# Make sure the Apt package lists are up to date, so we're downloading versions that exist.
cookbook_file "apt-sources.list" do
  path "/etc/apt/sources.list"
end
execute 'apt_update' do
  command 'apt-get update'
end

# Base configuration recipe in Chef.
package "wget"
package "ntp"
package "php7.0-fpm"
package "nginx"
package "postgresql"
package "mysql-server"
package "php7.0-mysql"
package "php7.0-exif"
package "php7.0-gd"
package "php7.0-mbstring"
cookbook_file "ntp.conf" do
  path "/etc/ntp.conf"
end
cookbook_file "nginx-default" do
  path "/etc/nginx/sites-available/default"
end
execute 'ntp_restart' do
  command 'service ntp restart'
end
execute 'nginx_reload' do
  command 'service nginx reload'
end

package 'composer'
package 'php-xml'
execute 'composer-up' do
  cwd '/home/ubuntu/project/webroot'
  command 'composer update && composer install'
end

bash 'mysql_db' do
  cwd '/home/ubuntu/project/webroot'
  code <<-EOH
    mysql -e "drop database if exists laravel;"
    mysql -e "create database if not exists laravel;"
    mysql -e "CREATE USER IF NOT EXISTS 'laravel'@'localhost' IDENTIFIED BY 'laravel';"
    mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'laravel'@'localhost';"
    mysql -e "FLUSH PRIVILEGES;"
    php artisan migrate
    php artisan optimize
    php artisan db:seed
    php artisan vendor:publish --tag=lfm_config
    php artisan vendor:publish --tag=lfm_public
    EOH
end
