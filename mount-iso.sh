#!/bin/bash
set -e

mkdir ./iso-path

mount Additional.iso ./iso-path

cp -r ./iso-path ./iso-rw-path

umount ./iso-path

rm -rf ./iso-path

cd ./iso-rw-path/docker/ && docker load -i mariadb_latest.tar && docker load -i site_latest.tar


