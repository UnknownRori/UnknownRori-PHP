from json import dumps
from os import system, name
from core.console.server import Server
# from server import Server

Version = 0.1

def clear():
    if name == 'nt':
        _ = system('cls')
    else:
        _ = system('clear')

class Command:

    menu = {
        '0' : 'Exit',
        '1' : 'Serve',
        '2' : 'Autoload',
        '3' : 'Clear',
        '4' : 'Version',
        '5' : 'Help',
    }

    def list(self) -> None:
        json_object = dumps(self.menu, indent = 4) 
        print(json_object)

    def execute(self, input) -> None:
        if input == '':
            return
        elif self.verify(input, '0'):
            print("\n Good bye! \n")
            exit()
        elif self.verify(input, '1'):
            Server.Start()
        elif self.verify(input, '2'):
            system("composer dump-autoload")
        elif self.verify(input, '3'):
            clear()
            print("UnknownRori Basic CLI")
        elif self.verify(input, '4'):
            print(f">> UnknownRori CLI Version : v.{Version}")
        elif self.verify(input, '5'):
            self.list(Command)
        else:
            print(f"There is no available command called {input}, try pressing Help")

    def verify(input:str, id:str) -> bool:
        return input == str(id) or input == Command.menu[str(id)]