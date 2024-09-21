Plantones
=========



## Docker

```bash
rm -rf vendor/ composer.lock
```

### DEV

```bash
docker kill plantones.localhost
docker kill phpmyadmin.plantones.localhost
docker kill mysql.plantones.localhost

docker rm plantones.localhost
docker rm phpmyadmin.plantones.localhost
docker rm mysql.plantones.localhost

docker rmi -f plantones-plantones.localhost
docker rmi -f plantones-mysql.plantones.localhost

```

```bash
docker compose up -d

```