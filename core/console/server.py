from os import system
# php -S localhost:8080 ./public/index.php

class Server:
    def Start():
        # Customizable
        host = '127.0.0.1'
        port = '8080'
        path = './public/index.php'
        
        print(f"Server is running at {host} in port {port} and serving at path {path}")
        print("To shutdown development server press control + c and please ignore the error")

        system(f'php -S {host}:{port} {path}')
    pass