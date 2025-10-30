#!/bin/bash
set -e

mkdir ./iso-path

mount Additional.iso ./iso-path

cp ./iso-path ./iso-rw-path

cd ./iso-rw-path/docker/ && docker load -i mariadb_latest.tar && docker load -i site_latest.tar


