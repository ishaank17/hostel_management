
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
admin="ishaankkamath@gmail.com"


sender_email = admin
password = "tctn ncrr kqcg ydcl"  
receiver_email = admin

subject = "There is an new issue request."
body ="""Kindly login into your hostel portal to view more details







This is an Auto-Generated Email
"""

# Create the message
message = MIMEMultipart()
message["From"] = sender_email
message["To"] = receiver_email
message["Subject"] = subject

message.attach(MIMEText(body, "plain"))

try:
    with smtplib.SMTP_SSL("smtp.gmail.com", 465) as server:
        server.login(sender_email, password)
        server.sendmail(sender_email, receiver_email, message.as_string())
    print("Email sent successfully!")
except Exception as e:
    print("Failed to send email:", e)

    