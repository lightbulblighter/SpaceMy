# SpaceMy
MySpace 'recreation', replicating the forgotten sense of user customizability found in MySpace. A work-in-progress social network.

## License
This is free and unencumbered software released into the public domain.

## Credits
Though SpaceMy is actively being developed by a community of 100+ people, we'd like to give our thanks for a few amazing contributions.

- Logo: Hitius (@exieln)
- Inspiration: FederaGonza
- Programming: lightbulblighter
- WebSite Design: Mafftere
- WrongThink Moderation: @johnfortnitekennedyCorp
- Morale Support: sciencekid

## Notice
Please be advised that this is the *official* SpaceMy repository. We have been anonymously notified by someone that there exists a fraud copy of this code in order to trick and decieve users into giving away their passwords. Action has since been taken and GitHub has been contacted about this issue, but please be advised that all information about SpaceMy development will come from here.

## How to set up
### Prerequisites
- Docker

### Process
1. Clone the Git repository to a folder
2. Configure your setup in `docker-compose.sample.yml` with stuff such as MySQL passwords, etc.
3. Match the compose configuration with the website's environment in `/website/data/environment/`. Each setting is documented, so this should be fairly easy.
4. Run `docker-compose up --build --force-recreate` on the root folder.
5. There should now be a folder named `container`. Copy `/website/data/` into `/container/website/data/`.
6. Everything *should* be working at this point. If not, please submit an issue.