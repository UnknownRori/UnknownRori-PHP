# This file is used to automate the running local development server
# This is not python framework this is php framework and the python is just to automate thing
# If you don't have python installed you can use this command on your terminal
# command : php -S localhost:8080 ./public/index.php
# Note this project is licensed using MIT, Recommended Python 3!

from core.console.command import Command
from core.console.input import Input
from json import dumps

def main():
    print("UnknownRori Console")
    command = ''
    while True:
        command = Input('Prompt : ')
        Command.execute(Command, command)

if __name__ == '__main__':
    main()