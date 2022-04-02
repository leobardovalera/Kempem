from docxtpl import DocxTemplate, InlineImage
import sys
from docx.shared import Mm

template = sys.argv[1]

doc = DocxTemplate(template)

context = { 
    'nombres' : sys.argv[3],
    'apellidos' : sys.argv[4],
    'organizacion' : sys.argv[5],
    'fecha' : sys.argv[6],
    'grafico1': InlineImage(doc, sys.argv[7]+'/graph1.jpg', width=Mm(150)),
    'grafico2': InlineImage(doc, sys.argv[7]+'/graph2.jpg', width=Mm(150)),
    'grafico3': InlineImage(doc, sys.argv[7]+'/graph3.jpg', width=Mm(150)),
}

doc.render(context)

doc.save(sys.argv[2])
