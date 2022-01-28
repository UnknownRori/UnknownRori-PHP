from json import dumps
from os import system, name
from core.console.server import Server
# from server import Server

class Console:
    author = {
        'name' : 'UnknownRori',
        'color' :'green'
    }
    title = f"{author['name']} Basic PHP CLI"

    version = 0.2

    menu = {
        '0' : 'Exit',
        '1' : 'Serve',
        '2' : 'Autoload',
        '3' : 'Clear',
        '4' : 'Version',
        '5' : 'Install',
        '6' : 'Help',
    }

    def clear():
        if name == 'nt':
            _ = system('cls')
        else:
            _ = system('clear')

    def list(self) -> None:
        json_object = dumps(self.menu, indent = 4) 
        print(json_object)

    def execute(self, input) -> None:
        if input == '':
            return
        elif self.verify(input, '0'):
            print("Good bye!")
            Console.clear()
            exit()
        elif self.verify(input, '1'):
            Server.Start()
        elif self.verify(input, '2'):
            system("composer dump-autoload")
        elif self.verify(input, '3'):
            Console.clear()
            print(Console.title)
        elif self.verify(input, '4'):
            print(f">> UnknownRori CLI Version : v.{Console.Version}")
        elif self.verify(input, '5'):
            system("composer install")
            system("composer dump-autoload")
            print("Build something amazing!")
        elif self.verify(input, '6'):
            Console.clear()
            self.list(Console)
        else:
            print(f"There is no available command called {input}, try pressing Help")

    def verify(input:str, id:str) -> bool:
        return input == str(id) or input == Console.menu[str(id)]