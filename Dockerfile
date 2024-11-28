FROM php:7.4-apache

# Installer les outils nécessaires, y compris base64, netcat, sudo et vim
RUN apt-get update && apt-get install -y coreutils ncat python3 sudo vim

# Ajouter l'utilisateur www-data au groupe sudoers avec les permissions nécessaires
RUN echo "www-data ALL=(ALL) NOPASSWD: /usr/bin/vim" >> /etc/sudoers

# Copier les fichiers de l'application
COPY src/ /var/www/html/

# Ajouter le fichier web.txt avec un flag dans /var/www/html
RUN echo "epictf{nave_ruobf}" > /var/www/web.txt

# Ajouter le fichier root.txt avec un flag dans /root
RUN echo "epictf{goaaaaaaaaaaaaaatt}" > /root/root.txt

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]