# SpaceMy
MySpace 'recreation', replicating the forgotten sense of user customizability found in MySpace. A work-in-progress social network.

# License
This is free and unencumbered software released into the public domain.

# How to set up
## Prerequisites
1. Docker

## Process
1. Clone the Git repository to a folder
2. Configure your setup in `docker-compose.sample.yml` with stuff such as MySQL passwords, etc.
3. Match the compose configuration with the website's environment in `/website/data/environment/`. Each setting is documented, so this should be fairly easy.
4. Run `docker-compose up --build --force-recreate` on the root folder.
5. There should now be a folder named `container`. Copy `/website/data/` into `/container/website/data/`.
6. Everything *should* be working at this point. If not, please submit an issue.