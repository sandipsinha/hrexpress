def send_temp(action,to,name,req_num,start_dt,bus_title,dept,location,division,legal,manager,bus_email,Comments):
    import smtplib
    from email.mime.multipart import MIMEMultipart
    from email.mime.text import MIMEText
    
    me='hr2ad-errors@polycom.com'
    msg=MIMEMultipart('alternative')
    msg['Subject'] = 'New Regular Employee ' + name + ' Start Date: '  + start_dt
    msg['To']=to
    FooterTxt = manager + ' - Please call HRIS with any questions regarding your new hire. You will need to contact the IT Helpdesk to coordinate the setup and delivery of IT resources for your new hire 3 \
    days prior to  their arrival; you can reach the Helpdesk staff at (888)488-9438 or +1 (916) 515-3169 during normal business hours to assist you with your IT requirements.'
    html = """\
    <html>
      <head><STYLE type=text/css>
         td {font-family: Arial, Helvetica, sans-serif; font-size: small; background-color: #ffffff;}
         div {font-family: Arial, Helvetica, sans-serif; font-size: small; background-color: #ffffff;}
         table {cellpadding: 3; cellspacing: 1; border: 1px solid #000000; background-color: #000000}
         table.NoBorder {border: 0px solid #ffffff; cellpadding: 3; cellspacing: 1; background-color: #ffffff}
         td.header {color:red; font-size: medium;}
         p.HeaderFont {font-family: Arial; font-size: medium; color: red;}
       </STYLE> </head><body>
       <p class=HeaderFont>Personal & Confidential</p>
       <table class=NoBorder><tr><td class=header>
      """ + name + """ will be joining as a Regular Employee. Here are the details that you will need to complete your responsibilities.</td><tr></table><br><br>
       <table cellpadding=3 cellspacing=1 bgcolor=000000><tr><td> Name </td><td>""" + name + """</td></td>
       <tr><td> Requisition # </td><td>""" + req_num + """</td></td>
       <tr><td> Start Date </td><td>""" + start_dt + """</td></td>
       <tr><td> Business Title </td><td>""" + bus_title + """</td></td>
       <tr><td> Department </td><td>""" + dept + """</td></td>
       <tr><td> Location </td><td>""" + location + """</td></td>
       <tr><td> Financial Division </td><td>""" + division + """</td></td>
       <tr><td> Legal Entity </td><td>""" + legal + """</td></td>
       <tr><td> Manager </td><td>""" + manager + """</td></td>
       <tr><td> Comments </td><td>""" + Comments + """</td></td>
       </table>
       <br><br><table class=NoBorder><tr><td> <font face=arial size=small color=red>*Manager</font> - """ + FooterTxt + """</td></tr></table>
       </body>
       </html>
    """   
    smtpserver= smtplib.SMTP('mailrelay.polycom.com',25)
    part1=MIMEText(html,'html')
    msg.attach(part1)
    smtpserver.ehlo()
    #smtpserver.login(auth_user,auth_pass)
    #print html
    #msg = header + '\n this is test mesg from Sandip \n\n'
    smtpserver.sendmail(me,to,msg.as_string())
    print 'success';
    smtpserver.close()
