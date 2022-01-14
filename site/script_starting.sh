#!/bin/bash

docker start sti_project;
docker exec -u root sti_project service nginx start;
docker exec -u root sti_project service php5-fpm start;
sudo chmod -R 777 databases;
