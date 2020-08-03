# TypicalName
steals your passwords.

# SpaceMy
A remake/fan recreation of MySpace, with goals to recreate the user customizability forgotten in modern social networking.

This repository contains no copyrighted, or stolen code. All content here is 100% original. SpaceMy is not sponsored by, or hosted by MySpace.

## Features
- Selling Feature: Customizability
    - User CSS modification
    - Jukebox, upload a song that represents you
    - Site customizability is up to the user
- User security
    - We don't collect your data, either:
        - The only data collected using the SpaceMy webservice is your E-Mail address, which only happens via registration.
    - We don't sell your data
    - All private user details (e.g E-Mail addresses) are securely encrypted with military grade encryption
    - Modern-day Argon2 password hashing, winner of the [Password Hashing Contest](https://password-hashing.net/)
    - Extensive privacy controls
    - Top-notch security
- Open source, public domain software
- Programmed by someone with over 10 braincells
- Docker, which makes setting up exponentially easier, and helps with security

## How can I help?
If you know how to code, contribute using pull requests. If you like to test stuff, join the website and test the craziest stuff you can think of and try to find bugs, then report them in issues. Everything helps!

## License
This is free and unencumbered software released into the public domain.

## Credits
Though SpaceMy is actively being developed by a community of 100+ people, we'd like to give our thanks for a few amazing contributions.

- Logo: Hitius (@exieln)
- Inspiration: veno
- Programming: lightbulblighter
- Website Design: Mafftere
- Wrongthink moderation: @johnfortnitekennedyCorp
- Morale support: sciencekid

## Notice
Please be advised that this is the *official* SpaceMy repository. We have been anonymously notified by someone that there exists a fraud copy of this code in order to trick and decieve users into giving away their passwords. Action has since been taken and GitHub has been contacted about this issue, but please be advised that all information about SpaceMy development will come from here.

SpaceMy is officially hosted at https://spacemy.rboxlo.xyz/.

## Contact
Visit us at https://spacemy.rboxlo.xyz/

Join our Discord server at https://discord.gg/byVHycY

E-Mail us at spacemy@rboxlo.xyz

## How to set up
### Prerequisites
- Docker

### Process
1. Clone the Git repository to a folder
2. Configure your setup in `docker-compose.sample.yml` with stuff such as MySQL passwords, etc.
3. Match the compose configuration with the website's environment in `/website/data/environment/`. Each setting is documented, so this should be fairly easy.
4. Run `docker-compose up --build --force-recreate --remove-orphans` on the root folder.
5. There should now be a folder named `container`. Copy `/website/data/` into `/container/website/data/`.
6. Everything *should* be working at this point. If not, please submit an issue.

The README is copyrighted by lightbulblighter (Fawad Chaudhry) and is not permitted for reuse or copying without explicit permission by lightbulblighter.
