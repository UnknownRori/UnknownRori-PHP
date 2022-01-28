# This file is used to automate the running local development server
# This is not python framework this is php framework and the python is just to automate thing
# If you don't have python installed you can use this command on your terminal
# command : php -S localhost:8080 -t ./public ./public/index.php
# Note this project is licensed using MIT, Recommended Python 3!

from core.console.input import Input
from core.console.console import Console

def main():
    Console.clear()
    print(Console.title)
    command = ''
    while True:
        command = Input()
        Console.execute(Console, command)

if __name__ == '__main__':
    main()