import smtplib
import sys
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

sender_email = "ishaankkamath@gmail.com"
password = "tctn ncrr kqcg ydcl"  
receiver_email = "\""+sys.argv[1]+"\""

subject = "Your Laundry has been requested"
body = """
Your Laundry has been requested







This is an Auto-Generated Email"""


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

    