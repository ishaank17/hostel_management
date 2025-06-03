import smtplib
import sys
# fc3dca0b05e100fbaf50153bd4fa9445

sender = "Hostel Management Sytem <hello@demomailtrap.co>"
receiver = "User <"+sys.argv[1]+">"

message = f"""\
Subject: There is an  update on your issue request.
To: {receiver}
From: {sender}

Kindly login into your hostel portal to view more details







This is an Auto-Generated Email"""
# print(receiver)
with smtplib.SMTP("live.smtp.mailtrap.io", 587) as server:
    server.starttls()
    server.login("api", "fc3dca0b05e100fbaf50153bd4fa9445")
    server.sendmail(sender, receiver, message)
    