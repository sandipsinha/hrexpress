import datetime,xlrd
import orcl_login
import sys
filename = '/home/sandip/phpproj/hrtemp/upload/dept_upld.xls'
wb=xlrd.open_workbook(filename,formatting_info=True)
wb.sheet_names()
rowarray =[]
sh = wb.sheet_by_index(0)
count=0
x=datetime.date.today()
import cx_Oracle
import ldap_chk
con=cx_Oracle.connect('ssinha/plcm!23@corpprddb10.polycom.com:1521/hrprod')
cur=con.cursor()
sysdate = datetime.date.today()
try:
   cur.execute('delete from ps_pol_dpt_chng')
except Exception, e:
            print repr(e)
con.commit()
   
for rx in range(sh.nrows):
    if (rx > 0):
        a2 = datetime.date(*xlrd.xldate_as_tuple(sh.cell_value(1,1),0)[:3])
        rowarray.append((sh.cell_value(rx,0),a2,sh.cell_value(rx,4)))
        #rowarray.append((sh.cell_value(rx,0),0,sh.cell_value(rx,5),a2,sh.cell_value(rx,5),'',sh.cell_value(rx,3),sh.cell_value(rx,4),x,'Added by script'))
        count +=1
cur.bindarraysize = count
cur.setinputsizes(int,20)
try:
    #cur.executemany("insert into ps_pol_var_pymnt (emplid,empl_rcd,pol_comment_type,effdt,pol_comments_by_cd,pol_followup_dt,award_value,currency_cd,last_update_date,comments)
    #values(:1,:2,:3,:4,:5,:6,:7,:8,:9,:10)",rowarray)
    cur.executemany("insert into ps_pol_dpt_chng(emplid,effdt,department) values(:1,:2,:3)",rowarray)
except cx_Oracle.DatabaseError as e:
                    error, = e.args
                    print(error.code)
                    print(error.message)
con.commit()
print ('There are now' , count,' Rows in the pol_dept Table')


#try:
#    cur.execute("Insert into ps_pol_gen_comment select emplid,0,:1,:2,:3,'',amount,business_title,:4,'Updated by Script' \
#                from ps_pol_var_pymnt a where not exists(select 'x' from ps_pol_gen_comment b where a.emplid = b.emplid and b.effdt = :2 and b.pol_comment_type = :1)",q4)
#except cx_Oracle.DatabaseError as e:
#                    error, = e.args
#                    print(error.code)
#                    print(error.message)
#con.commit()
con.close()
        

        

                
