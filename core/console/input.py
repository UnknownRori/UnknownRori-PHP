import time
def Input(prompt = "Prompt : "):
    result = input(f"> {time.strftime('%X')} | {prompt}").title()
    return result