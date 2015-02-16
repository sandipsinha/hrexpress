import sys
import MySQLdb

def returnhtml(self):
  dictitem = {'url1':'HTML ELEMENT 1','url2':'HTML ELEMENT 2'}
  request = self.context.REQUEST
  para = request.get('urlvariable', None)
  if para:
    return dictitem[para]

returnhtml()


#from mail_temp import send_temp
db=MySQLdb.connect("localhost","orclsql","tan5321","hrexpress")
x=db.cursor()
to='sandip.sinha@polycom.com'
id = sys.argv[1]

x.execute("select a.effdt,a.action_type,a.last_name,a.first_name,type,a.classification,a.req_num,a.business_title,a.location,a.dept,a.emplid,a.busn_email, \
a.supervisor,x.name,a.it_end_date,finance,a.vp,a.hr_contact,y.name hr_name,a.busn_phone,a.legal_entity,a.comments,a.financial_org from consultants a left join emp_current_vw x  on a.supervisor = x.emplid \
left join emp_current_vw y on  a.hr_contact = y.emplid where id = %s and a.effdt=(select max(b.effdt) from consultants b where a.id = b.id)",id)
rows = x.fetchall()
for row in rows:
  #if check_ldap(row[0],row[10]) == 'Y':
  name  = row[3] +' ' +  row[2]
  comments = row[22]
  execfile("mail_temp.py")
  send_temp('hire',to,name,row[6],row[0].strftime('%m/%d/%y'),row[7],row[9],row[6],row[7],row[8],row[9],row[10],row[22])

x.close()


