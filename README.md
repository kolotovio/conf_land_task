## Conf Registration Landing App

#### Before Start

For deploying the app in your system must be installed:

- [Docker Engine](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

For some comfort use, add to end of your system host file (/etc/hosts) test domain:

```bash
# App test domain for local deploy
127.0.0.1 conflandtask.test
```

---

For starting app follow these steps:

1. Type in console `docker-compose build` for build a containers and then `docker-compose up -d` for start them in "silent" mode
2. For install App packages by Composer, you need to inter to container with PHP. Type in console `docker exec -it conflandtask_php bash` and then `composer install`. For exit from container, just type `exit` in console