from os import system
# php -S localhost:8080 -t ./public ./public/index.php

class Server:
    def Start():
        # Customizable
        host = '127.0.0.1'
        port = '8080'
        public = './public'
        router = './public/index.php'
        
        print(f"Server is running at {host} in port {port} with router path {router} and serving at path {public}")
        print("To shutdown development server press control + c and please ignore the error")

        system(f'php -S {host}:{port} -t {public} {router}')
    pass