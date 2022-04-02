import sys, os
from docxtpl import DocxTemplate, InlineImage
from docx.shared import Mm

template = sys.argv[1]
doc = DocxTemplate(template)

context = {}
for value in sys.argv[5:]:
    value = value.split('_')
    #print(value)
    if(value[0] == 'G'):
        #print(sys.argv[3]+value[2]+'.png')
        context[value[1]] = InlineImage(doc, sys.argv[3]+value[2]+'.png', width=Mm(150))
    else:
        context[value[1]] = value[2]

# Se verifica si existe el archivo para borrarlo
Finalfile = sys.argv[3]+'Reporte Grupal - '+sys.argv[4]+'.docx'
if os.path.exists(Finalfile):
    os.remove(Finalfile)

doc.render(context)
doc.save(Finalfile)
print(Finalfile)
