import time
def Input(prompt = ">>"):
    result = input(f"{time.strftime('%X')} {prompt} ").title()
    return result