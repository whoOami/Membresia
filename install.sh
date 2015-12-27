if [ -f /usr/bin/composer ] || [ -f /usr/local/bin/composer ]; then
	echo "Actualizando dependencias."
	composer update
else
	if [ -f composer.phar ]; then
		echo "Actualizando dependencias."
		./composer.phar update
	else
		echo "Composer no encontrado, descargando composer"
		if [ -f /usr/bin/curl ]; then
			curl -sS https://getcomposer.org/installer | php
		else 
			php -r "readfile('https://getcomposer.org/installer');" | php
		fi
		echo "Actualizando dependencias."
		./composer.phar update
		echo "¿Desea instalar Composer permanentemente en su sistema? [S/N]";
		read response
		response=$(echo $response | tr 'a-z' 'A-Z')
		if [ $response == "S" ] || [ $response == "SI" ]; then 
			echo "Instalando composer..."
			sudo mv composer.phar /usr/local/bin/composer
		else
			rm composer.phar
		fi
	fi
fi
echo "Activando módulos de php"
sudo a2enmod mcypt
sudo a2enmod rewrite
echo "Configurando permisos de directorios"
sudo chmod 777 -R vendor/
sudo chmod 777 -R storage/
sudo chmod 777 -R bootstrap/cache/
