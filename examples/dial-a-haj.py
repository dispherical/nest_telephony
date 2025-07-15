# All are in B&W 12 encoded in QSSTV :3
from baresipy import BareSIP
from time import sleep
import os
import random

gateway = "pbx.hackclub.app"
user = "2524"
pswd = "[redacted]"

class Main(BareSIP):
    def handle_incoming_call(self, number):
        self.accept_call()

    def handle_call_established(self):
        sharks_dir = os.path.join("sharks")
        wav_files = [f for f in os.listdir(sharks_dir) if f.lower().endswith('.wav')]
        if wav_files:
            chosen = random.choice(wav_files)
            self.send_audio(os.path.join(sharks_dir, chosen))
        self.hang()


b = Main(user, pswd, gateway)

while b.running:
    sleep(1)
