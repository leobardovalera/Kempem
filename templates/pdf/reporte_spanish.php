<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;700&display=swap" rel="stylesheet">
<style>
    body, html{
        font-family: 'Fira Sans', sans-serif;
        font-size: 18px;
        margin: 0;
        padding: 0;
    }
    h1, h2{
        text-align:center;
    }
    .page{
        padding-top: 80px;
        position: relative;
        page-break-after: always;
        height: 1278px;
        background-image: url(data:image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/img/reporte/Fondo.png')) ?>);
        background-position: top left;
        background-size: cover;
    }
    .page.last-page{
        background-image: url(data:image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/img/reporte/Fondo_final.png')) ?>);
        display:flex;
        align-items:center;
    }
    p, h3{
        text-align: justify;
        margin: 0px 200px 15px;
    }
    table{
        margin: 0px 150px 15px;
    }
    .justificado{
        padding: 5px 0 0 5px;
        text-align: justify;
    }
    .centrado{
        margin: 0 auto;
        display: block;
        text-align: center;
    }
    .atributos{
        padding: 5px 0 0 5px;
        text-align: justify;
        font-size: 12px;
        border-bottom: 1px solid #000000;
    }
    .atributos.head{
        text-align: center;
    }
    .logo_page{
        position: absolute;
        top: 30px;
        left: 30px;
    }
    .copyright{
        font-size: 14px;
        position: absolute;
        bottom: 30px;
        left: 30px;
        width: 100%;
    }
    .pagination{
        text-align: right;
        font-size: 14px;
        font-weight: bolder;
        position: absolute;
        bottom: 30px;
        right: 30px;
        width: 100%;
    }
    .semaforo{
        margin: 0 auto;
        display: block;
        width: 60%;
    }
    .rojo{
        color: #ffffff;
        background-color: #df3623;
        text-align: center;
        display: flex;
        align-items:center;
        padding: 20px;
    }
    .amarillo{
        color: #ffffff;
        background-color: #fec41b;
        text-align: center;
        display: flex;
        align-items:center;
        padding: 20px;
    }
    .verde{
        color: #ffffff;
        background-color: #1a7436;
        text-align: center;
        display: flex;
        align-items:center;
        padding: 20px;
    }
</style>
<div class="page">
    <div style="position: absolute; top: 30%; width: 100%;">
        <img class="centrado" src="<?= WWW_ROOT ?>/img/reporte/1.png" alt="">
        <h1>INFORME DE RESULTADOS</h1>
        <h2><?= $evaluation->instrument->name ?></h2>
    </div>
    <div class="centrado" style="position: absolute; bottom: 100px; width: 100%;">
        <?= $evaluation->names ?> <?= $evaluation->lastnames ?><br>
        <?= $evaluation->sale->company->name ?><br>
        Realizado el <?= $evaluation->completed->i18nformat('dd/MM/YYYY') ?>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">1 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>T??RMINOS Y CONDICIONES</h2>
        <p>
            Este informe de resultados ha sido elaborado por KEMPEM mediante una
            plataforma tecnol??gica dise??ada para tal fin. De acuerdo con los t??rminos y
            condiciones que acept?? al momento de participar, le informamos que los
            datos personales proporcionados y procesados ser??n tratados con estricta
            confidencialidad. De ninguna manera ser??n compartidos, cedidos, vendidos,
            intercambiados o utilizados de forma individual, sin su consentimiento
            expreso. Nuestro modelo se rige por el Reglamento General de Protecci??n de
            Datos de la Uni??n Europea (RGPD) y por la legislaci??n nacional e internacional
            sobre propiedad intelectual e industrial. Salvo en el informe personalizado, 
            los resultados y an??lisis nunca se mostrar??n p??blicamente de manera individual, 
            solo de forma grupal. Los investigadores autorizados para entrar en contacto 
            con sus datos personales, est??n comprometidos a cumplir con las precauciones 
            t??cnicas y organizativas necesarias para garantizar el mayor nivel de seguridad 
            posible de sus datos y resultados. Usted como usuario, dispone de un derecho 
            de uso estrictamente privado y exclusivo, con la finalidad de disfrutar de las 
            prestaciones de los productos y servicios proporcionados por KEMPEM.</p>
            <p>
            KEMPEM se reserva todos los derechos de propiedad intelectual e industrial 
            sobre marcas, logotipos, signos distintivos, dise??o gr??fico, modelos te??ricos, 
            dimensiones, atributos y su combinaci??n, ??tems, definiciones, descripciones, 
            gr??ficos de resultados, modelos, procesos y an??lisis estad??stico, an??lisis de 
            datos, instrumentos de medici??n y recolecci??n de datos, encuestas, cuestionarios, 
            algoritmos, dise??o y estructura de informes de resultados, presentaciones, y 
            literatura relacionados con la medici??n y an??lisis global de competencias, 
            atributos y caracter??sticas personales, organizacionales, profesionales, 
            ejecutivas, laborales o emprendedoras y su valoraci??n objetiva individual y 
            grupal, los cuales han sido desarrollados in??ditamente por KEMPEM como 
            resultado de investigaciones previas y en desarrollo que ha realizado desde 
            el 2009. En ning??n caso, se entender?? que la utilizaci??n de productos y 
            servicios derivados de nuestro intercambio le confieren al usuario o al 
            cliente derecho alguno, ni implica una renuncia, transmisi??n, licencia o 
            cesi??n total o parcial de dichos derechos por parte de KEMPEM. </p>
            <p>
            Queda prohibido modificar, copiar, transformar, reproducir, divulgar o
            distribuir de cualquier forma, total o parcial cualesquiera de los elementos
            propiedad intelectual e industrial de KEMPEM, para prop??sitos p??blicos,
            privados y/o comerciales. Se proh??be el uso, divulgaci??n o reproducci??n de
            este material o de su contenido total o parcialmente, a menos que usted,
            como usuario, sea autorizado expresamente y por escrito por KEMPEM.</p>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">2 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>CONTENIDO DE ESTE INFORME DE RESULTADOS</h2>
        <img class="centrado" src="<?= WWW_ROOT ?>/img/reporte/3.png" style="width: 900px; position: relative; left: 50%; margin-left: -450px;" alt="">
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">3 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 150px">
        <h2>MODELO KEMPEM</h2>
        <p>
        Las competencias son comportamientos que algunas personas dominan mejor que 
        otras, lo que las hace eficientes en una situaci??n determinada. Considerando 
        que el emprendimiento se traduce en comportamientos, el enfoque basado en 
        competencias expresa con mayor precisi??n aquellos atributos necesarios para 
        la generaci??n de tales comportamientos. ??Que?? es la competencia emprendedora? 
        ??Cu??les son sus dimensiones? ??Cu??les son sus atributos?</p>
        <p>
        El Modelo KEMPEM es una metodolog??a validada y automatizada que permite medir 
        y analizar 20 atributos de la competencia emprendedora agrupados en 3 
        dimensiones: a) conocimientos, b) habilidades y, c) actitudes y valores); 
        muestra el desempe??o actual y el nivel de madurez del potencial emprendedor. 
        La validez y fiabilidad de la metodolog??a ha sido probada en varios grupos de 
        inter??s: emprendedores, empleados, gerentes y estudiantes universitarios, de 
        varios pa??ses, incluso, se han realizado algunas mediciones en adolescentes.</p>
        <p>
        Evaluamos los atributos que condicionan la acci??n emprendedora en los individuos, 
        as?? como las formas efectivas de estimularlos. Es por ello que, con una 
        investigaci??n iniciada en el 2009, hemos definido, medido, analizado y validado 
        los atributos del emprendedor y el valor de ??stos en la creaci??n, crecimiento y 
        fortalecimiento empresarial. Ello nos llev?? a desarrollar metodolog??as, modelos 
        te??ricos y estad??sticos de an??lisis, algoritmos e instrumentos propios que permiten 
        identificar, clasificar y jerarquizar el perfil del emprendedor. Para realizar 
        los an??lisis, se utilizan herramientas de inteligencia artificial, espec??ficamente 
        redes neuronales (deep learning) las cuales eval??an sin sesgos ni intervenci??n 
        humana (aprendizaje no supervisado), el desempe??o actual y predicen el desempe??o 
        futuro de la persona. KEMPEM involucra varias capas de algoritmo que trabajan con 
        grandes vol??menes de datos no estructurados o etiquetados que le permiten aprender 
        aut??nomamente, con lo cual en la medida que se ingresan m??s datos, el sistema se 
        optimiza haci??ndose m??s efectivo y eficiente.</p>
        <p>
        El modelo tiene un 95% de confianza para todos sus ??tems; una precisi??n en la 
        caracterizaci??n del potencial emprendedor superior al 98% y un 99% de clasificaci??n 
        correcta. Adicionalmente, los resultados obtenidos por usted son comparados con una 
        base de datos propia constituida por m??s de 7.200 personas que ya participaron en 
        este estudio.</p>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">4 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 50px">
    <h2>MODELO KEMPEM: ATRIBUTOS ANALIZADOS</h2>
    <table>
        <tr>
            <th class="atributos head" width="15%">
                APRENDIZAJE AUT??NOMO
            </th>
            <td class="atributos" width="85%">
                Facultad para tomar informaci??n conceptual y abstracta sobre d??nde y c??mo obtener recursos poco
                apreciados, tanto expl??citos como t??citos y de c??mo utilizarlos eficientemente.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                APROVECHAR OPORTUNIDADES
            </th>
            <td class="atributos">
                Acci??n subjetiva orientada a la capacidad de identificar nuevas combinaciones de recursos e informaci??n
                disponibles mediante la indagaci??n constante en el medio ambiente y la observaci??n de los cambios.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                AUTOEFICACIA
            </th>
            <td class="atributos">
                Creencia que tiene un individuo en su capacidad individual de perseguir y persistir para lograr un objetivo,
                incluso ante el escepticismo de los dem??s.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PENSAMIENTO CR??TICO
            </th>
            <td class="atributos">
                Capacidad para realizar evaluaciones, juicios o tomar decisiones asociadas al an??lisis de una oportunidad, la
                creaci??n de un negocio y su crecimiento, mediante el uso de modelos mentales simplificados orientados a
                unir informaci??n que previamente se encontraba inconexa.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                COMPETITIVIDAD
            </th>
            <td class="atributos">
                Acci??n-emoci??n compleja de un individuo que se encuentra involucrado de forma agresiva en una lucha
                cr??nica e incesante para alcanzar m??s en menos tiempo y que, de ser necesario, lo har?? en contra de los
                esfuerzos opuestos de otras situaciones, medios o personas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LEGITIMIDAD
            </th>
            <td class="atributos">
                Manipulaci??n deliberada del individuo y su proyecto, lo cual permite a los actores externos percibir una
                sensaci??n de permanencia relativa del proyecto que se inicia.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                CREATIVIDAD E INNOVACI??N
            </th>
            <td class="atributos">
                Patr??n de comportamiento de un individuo que se encuentra interesado en crear el cambio y llevar
                adelante una din??mica que empuje al mercado sobre un modelo de desequilibrio que permita desarrollar,
                adquirir, construir o administrar nuevos productos, procesos, servicios, materias primas, y m??todos de
                organizaci??n.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                DESARROLLO DE REDES DE CONTACTOS
            </th>
            <td class="atributos">
                Consiste en construir y transformar relaciones de naturaleza afectiva en relaciones de naturaleza
                instrumental, con la finalidad de adquirir confianza, ser m??s eficientes, promover el intercambio de
                recursos, proveer ideas, acceder a oportunidades de negocios privilegiadas y obtener el compromiso, ayuda
                y destrezas de los actores involucrados para materializar un proyecto o tarea y mejorar la innovaci??n.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                CONFIANZA
            </th>
            <td class="atributos">
                Surge cuando los individuos son demasiado optimistas o irracionalmente confiados en el an??lisis que hacen
                de una situaci??n, excedi??ndose en sus habilidades de estimaci??n y no reconociendo la incertidumbre que
                realmente existe.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                EXPERIENCIA PREVIA
            </th>
            <td class="atributos">
                Conocimiento t??cito adquirido a partir de las pr??cticas asociadas al aprendizaje del individuo, incluye
                experiencias laborales, profesionales, de startup, gerenciales y aquellas que son adquiridas por la relaci??n
                con una industria espec??fica.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                INCONFORMIDAD E INDIVIDUALISMO
            </th>
            <td class="atributos">
                Este comportamiento trae consigo ejecutar una serie de iniciativas que contribuyen a mejorar el entorno,
                implica pensar a t??tulo personal fuera de los m??rgenes establecidos para la generaci??n de nuevos
                productos, procesos, servicios, mercados, proyectos o empresas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LIDERAZGO
            </th>
            <td class="atributos">
                Capacidad de definir una visi??n de lo que es posible y atraer a las personas para trabajar conjuntamente en
                ello, a fin de transformarla en realidad, facilitando esfuerzos individuales y colectivos para lograr un
                objetivo compartido.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LOCUS DE CONTROL INTERNO
            </th>
            <td class="atributos">
                Percepci??n de que las recompensas son consecuencia del comportamiento de un individuo, es decir, la
                capacidad percibida por los sujetos para influenciar directamente en los acontecimientos de sus vidas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                MOTIVACI??N
            </th>
            <td class="atributos">
                Incentivo que conduce a las personas a realizar acciones espec??ficas y que necesariamente debe ser
                intr??nseco, bien, porque est??n motivados a lograr sus metas, porque disfrutan haci??ndolo, porque obtienen
                satisfacci??n personal o porque la actividad es significativa en s?? misma para ellos.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSISTENCIA
            </th>
            <td class="atributos">
                Continuidad de acciones que implican esfuerzo intenso durante largas y dif??ciles horas, sin importar los
                obst??culos que se presenten con el fin de cumplir los objetivos propuestos. El nivel de compromiso ayuda a
                los individuos a superar el cansancio y los fracasos para cumplir una meta.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSUASI??N
            </th>
            <td class="atributos">
                Proceso de influir o convencer a las personas para cambiar su actitud o comportamiento con el fin de definir
                una visi??n de lo que es posible o de lo que se desea lograr.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                POSESI??N DE INFORMACI??N
            </th>
            <td class="atributos">
                Abarca todos aquellos datos, conceptos o teor??as adquiridos previamente y que los individuos emplean
                durante el proceso de descubrimiento y aprovechamiento de oportunidades y la formaci??n de nuevos
                negocios.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TENDENCIA A ASUMIR RIESGOS
            </th>
            <td class="atributos">
                Probabilidad percibida de recibir recompensas asociadas con el ??xito de una situaci??n espec??fica y cuya
                alternativa provee menos recompensas, as?? como consecuencias menos severas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TOLERANCIA AL FRACASO E INCERTIDUMBRE
            </th>
            <td class="atributos">
                Capacidad de aceptar que el fracaso es una t??cnica de aprendizaje que provee la oportunidad de
                diagnosticar por qu?? ha ocurrido un error, los fracasos proporcionan informaci??n para descubrir
                incertidumbres que anteriormente eran impredecibles.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TOMA DE DECISIONES Y SOLUCI??N DE PROBLEMAS
            </th>
            <td class="atributos">
                Implica elegir entre efectos posibles de una acci??n empleando un conjunto de medios dados y, adem??s,
                elegir el conjunto de medios para lograr un efecto deseado, es aplicado especialmente en situaciones
                donde no existen tendencias hist??ricas, niveles anteriores de desempe??o y poca o ninguna informaci??n
                espec??fica, por ende, el futuro es altamente incierto y la naturaleza o caracter??sticas precisas de los
                objetivos no son conocidas con ning??n grado de certeza.
            </td>
        </tr>
    </table>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">5 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin: 250px 100px 0px;">
        <h2>GU??A PARA LA INTERPRETACI??N <br>
        DE LOS RESULTADOS</h2>
        <table>
            <tr>
                <th width="10%">
                    <img src="<?= WWW_ROOT ?>/img/reporte/4.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td width="90%">
                    Lea con atenci??n toda la informaci??n suministrada
                    en cada secci??n.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/5.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Revise detenidamente cada gr??fico y su significado.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/6.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    No existen respuestas correctas o incorrectas. Los
                    resultados obtenidos y expresados en este
                    informe, representan lo que usted considera su
                    comportamiento t??pico ante las situaciones
                    planteadas en cada uno de los ??tems.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/7.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Relacione sus comportamientos con los procesos
                    clave de su actividad y analice c??mo impactan en
                    su desempe??o presente y futuro.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/8.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Profundice en la comprensi??n del significado de
                    cada atributo y sus implicaciones para el logro
                    global de la competencia emprendedora.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/9.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Establezca planes de formaci??n orientados a
                    trabajar sobre los atributos d??biles.
                </td>
            </tr>
        </table>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">6 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 50px">
        <h2>RESULTADOS POR ATRIBUTOS</h2>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph2/'.$evaluation->id)) ?>" alt="">
        <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
        <div class="pagination">7 de 10</div>
        <p style="margin-top: 30px;">
        * El valor ideal representa la mayor puntuaci??n en cada atributo obtenido 
        por emprendedores de alto perfil. Este ideal puede variar con la incorporaci??n 
        de emprendedores con un nivel de desempe??o m??s alto y se optimiza el algoritmo 
        en la medida que se vayan incrementando los datos.
        </p>
    </div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 10px">
        <h2>RESULTADOS POR DIMENSIONES</h2>
        <table>
            <tr>
                <th width="15%">
                    <img src="<?= WWW_ROOT ?>/img/reporte/10.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td width="85%" class="justificado">
                    <b>CONOCIMIENTOS:</b> capacidad de representar mentalmente conjuntos de
                    datos, hechos, conceptos, nociones, informaci??n, proposiciones y
                    categor??as adquiridas en una o varias disciplinas mediante la
                    experiencia o el aprendizaje y que son necesarios para su adecuado
                    desempe??o.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/11.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>HABILIDADES:</b> capacidad para actuar e intervenir en la realidad
                    mediante el uso de procedimientos o procesos necesarios para el
                    desempe??o de cualquier actividad, f??sica o mental.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/12.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>ACTITUDES Y VALORES:</b> consiste en la disposici??n y motivaci??n del
                    individuo a la acci??n y a la puesta en pr??ctica de los valores ante
                    situaciones profesionales y de la vida y tiene como base su
                    autonom??a, autoestima y proyecto ??tico de vida. Adem??s,
                    corresponde al sistema de creencias y disposiciones afectivas
                    estables que la persona asume como pautas referenciales para
                    actuar de una determinada manera.
                </td>
            </tr>
        </table>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph1/'.$evaluation->id)) ?>" alt="">
        <p style="margin-top: 30px;">
        * El valor ideal representa la mayor puntuaci??n en cada dimensi??n obtenido 
        por emprendedores de alto perfil. Este ideal puede variar con la 
        incorporaci??n de emprendedores con un nivel de desempe??o m??s alto y se 
        optimiza el algoritmo en la medida que se vayan incrementando los datos. </p>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">8 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>NIVEL DE MADUREZ DEL POTENCIAL EMPRENDEDOR</h2>
        <p>
        En el gr??fico que se presenta a continuaci??n, se han establecido tres niveles de 
        madurez para clasificar y jerarquizar el potencial emprendedor: Bajo, medio y 
        alto. Estos niveles est??n representados mediante los colores correspondientes 
        a un sem??foro, para ayudarle a identificarlos de una forma familiar. 
        Es importante se??alar que, trat??ndose del an??lisis de atributos personales, 
        encontrar un perfil puro no es lo m??s habitual, con lo cual es probable que 
        se encuentre en situaciones mixtas.</p>
        <table class="semaforo" style="width: 500px; position: relative; left: 50%; margin: 30px 0px 30px -250px; display: block;">
            <tr>
                <td class="rojo">
                    MADUREZ BAJA
                </td>
                <td class="amarillo">
                    MADUREZ MEDIA
                </td>
                <td class="verde">
                    MADUREZ ALTA
                </td>
            </tr>
        </table>
        <h3 style="text-align: center;">Su nivel de madurez del potencial emprendedor:</h3>
        <img class="centrado" style="margin: 30px auto;" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph3/'.$evaluation->id)) ?>" alt="">
        <h3 style="text-align: center;">Interpretaci??n de los resultados:</h3>
        <table style="margin: 30px 150px;">
            <?php if($grafico < 3){ ?>
            <tr>
                <th width="20%" class="rojo">
                    Madurez Baja
                    De 0 a 3 puntos
                </th>
                <td width="80%" class="justificado">
                    Debe fortalecer su competencia emprendedora. Si realmente lo que desea
                    es emprender, a??n le queda camino por recorrer y aunque en su perfil se
                    pueden encontrar atributos emprendedores, estos no son suficientes para
                    comenzar y gestionar un proyecto emprendedor individualmente. Intente
                    analizar las razones y t??mese su tiempo para desarrollarse. Considere la
                    baja puntuaci??n de su cuestionario como una oportunidad para reconocer y
                    reforzar aquellos atributos m??s d??biles o complementarlos con otros
                    miembros de su equipo emprendedor. Recuerde que no es suficiente con
                    tener una buena idea, conocimientos del mercado o financiamiento, si
                    despu??s no se est?? preparado para afrontar los retos permanentes que
                    supone poner en marcha un emprendimiento.
                </td>
            </tr>
            <?php } ?>
            <?php if($grafico >= 3 && $grafico < 7){ ?>
            <tr>
                <th class="amarillo">
                    Madurez Media
                    De 3,1 a 7 puntos
                </th>
                <td class="justificado">
                    Re??ne muchas caracter??sticas para ser emprendedor. No obstante, debe
                    evaluar y fortalecer algunos de sus atributos. Analice esos puntos d??biles y
                    fije una serie de acciones concretas para mejorarlos en un determinado
                    plazo. Afrontar la puesta en marcha de un proyecto emprendedor requiere
                    que la competencia emprendedora est?? en un nivel mayor al obtenido.
                    Cuenta con la capacidad y visi??n para emprender, lo cual es un punto
                    fundamental.
                </td>
            </tr>
            <?php } ?>
            <?php if($grafico >= 7){ ?>
            <tr>
                <th class="verde">
                    Madurez Alta
                    De 7,1 a 10 puntos
                </th>
                <td class="justificado">
                    Muestra atributos suficientes para ser un excelente emprendedor. Estas
                    cualidades conjuntamente con el adecuado desarrollo de su proyecto, son
                    bases s??lidas para iniciar su camino hacia la ejecuci??n de su
                    emprendimiento. Puede que requiera informaci??n o asesoramiento sobre
                    temas puntuales para poner su emprendimiento en marcha, pero ya tiene
                    el nivel de madurez suficiente para iniciarse como emprendedor. Ello no
                    quiere decir que ya tenga asegurado el ??xito, pero sin duda los atributos
                    personales que posee son los necesarios para desempe??arse por encima de
                    los niveles promedios.
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="copyright">Copyright ?? KEMPEM. All rights reserved. Prohibido su uso, divulgaci??n y reproducci??n total o parcial</div>
    <div class="pagination">9 de 10</div>
</div>
<div class="page last-page">
    <div style="position: absolute; top: 30%; width: 100%; color: #ffffff">    
        <img class="centrado logo-final" src="<?= WWW_ROOT ?>/img/reporte/13.png" alt="">
        <h3 class="centrado">www.kempem.com</h3>
    </div>
</div>
