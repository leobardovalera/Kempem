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
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">1 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>TÉRMINOS Y CONDICIONES</h2>
        <p>
            Este informe de resultados ha sido elaborado por KEMPEM mediante una
            plataforma tecnológica diseñada para tal fin. De acuerdo con los términos y
            condiciones que aceptó al momento de participar, le informamos que los
            datos personales proporcionados y procesados serán tratados con estricta
            confidencialidad. De ninguna manera serán compartidos, cedidos, vendidos,
            intercambiados o utilizados de forma individual, sin su consentimiento
            expreso. Nuestro modelo se rige por el Reglamento General de Protección de
            Datos de la Unión Europea (RGPD) y por la legislación nacional e internacional
            sobre propiedad intelectual e industrial. Salvo en el informe personalizado, 
            los resultados y análisis nunca se mostrarán públicamente de manera individual, 
            solo de forma grupal. Los investigadores autorizados para entrar en contacto 
            con sus datos personales, están comprometidos a cumplir con las precauciones 
            técnicas y organizativas necesarias para garantizar el mayor nivel de seguridad 
            posible de sus datos y resultados. Usted como usuario, dispone de un derecho 
            de uso estrictamente privado y exclusivo, con la finalidad de disfrutar de las 
            prestaciones de los productos y servicios proporcionados por KEMPEM.</p>
            <p>
            KEMPEM se reserva todos los derechos de propiedad intelectual e industrial 
            sobre marcas, logotipos, signos distintivos, diseño gráfico, modelos teóricos, 
            dimensiones, atributos y su combinación, ítems, definiciones, descripciones, 
            gráficos de resultados, modelos, procesos y análisis estadístico, análisis de 
            datos, instrumentos de medición y recolección de datos, encuestas, cuestionarios, 
            algoritmos, diseño y estructura de informes de resultados, presentaciones, y 
            literatura relacionados con la medición y análisis global de competencias, 
            atributos y características personales, organizacionales, profesionales, 
            ejecutivas, laborales o emprendedoras y su valoración objetiva individual y 
            grupal, los cuales han sido desarrollados inéditamente por KEMPEM como 
            resultado de investigaciones previas y en desarrollo que ha realizado desde 
            el 2009. En ningún caso, se entenderá que la utilización de productos y 
            servicios derivados de nuestro intercambio le confieren al usuario o al 
            cliente derecho alguno, ni implica una renuncia, transmisión, licencia o 
            cesión total o parcial de dichos derechos por parte de KEMPEM. </p>
            <p>
            Queda prohibido modificar, copiar, transformar, reproducir, divulgar o
            distribuir de cualquier forma, total o parcial cualesquiera de los elementos
            propiedad intelectual e industrial de KEMPEM, para propósitos públicos,
            privados y/o comerciales. Se prohíbe el uso, divulgación o reproducción de
            este material o de su contenido total o parcialmente, a menos que usted,
            como usuario, sea autorizado expresamente y por escrito por KEMPEM.</p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">2 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>CONTENIDO DE ESTE INFORME DE RESULTADOS</h2>
        <img class="centrado" src="<?= WWW_ROOT ?>/img/reporte/3.png" style="width: 900px; position: relative; left: 50%; margin-left: -450px;" alt="">
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">3 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 150px">
        <h2>MODELO KEMPEM</h2>
        <p>
        Las competencias son comportamientos que algunas personas dominan mejor que 
        otras, lo que las hace eficientes en una situación determinada. Considerando 
        que el emprendimiento se traduce en comportamientos, el enfoque basado en 
        competencias expresa con mayor precisión aquellos atributos necesarios para 
        la generación de tales comportamientos. ¿Qué es la competencia emprendedora? 
        ¿Cuáles son sus dimensiones? ¿Cuáles son sus atributos?</p>
        <p>
        El Modelo KEMPEM es una metodología validada y automatizada que permite medir 
        y analizar 20 atributos de la competencia emprendedora agrupados en 3 
        dimensiones: a) conocimientos, b) habilidades y, c) actitudes y valores); 
        muestra el desempeño actual y el nivel de madurez del potencial emprendedor. 
        La validez y fiabilidad de la metodología ha sido probada en varios grupos de 
        interés: emprendedores, empleados, gerentes y estudiantes universitarios, de 
        varios países, incluso, se han realizado algunas mediciones en adolescentes.</p>
        <p>
        Evaluamos los atributos que condicionan la acción emprendedora en los individuos, 
        así como las formas efectivas de estimularlos. Es por ello que, con una 
        investigación iniciada en el 2009, hemos definido, medido, analizado y validado 
        los atributos del emprendedor y el valor de éstos en la creación, crecimiento y 
        fortalecimiento empresarial. Ello nos llevó a desarrollar metodologías, modelos 
        teóricos y estadísticos de análisis, algoritmos e instrumentos propios que permiten 
        identificar, clasificar y jerarquizar el perfil del emprendedor. Para realizar 
        los análisis, se utilizan herramientas de inteligencia artificial, específicamente 
        redes neuronales (deep learning) las cuales evalúan sin sesgos ni intervención 
        humana (aprendizaje no supervisado), el desempeño actual y predicen el desempeño 
        futuro de la persona. KEMPEM involucra varias capas de algoritmo que trabajan con 
        grandes volúmenes de datos no estructurados o etiquetados que le permiten aprender 
        autónomamente, con lo cual en la medida que se ingresan más datos, el sistema se 
        optimiza haciéndose más efectivo y eficiente.</p>
        <p>
        El modelo tiene un 95% de confianza para todos sus ítems; una precisión en la 
        caracterización del potencial emprendedor superior al 98% y un 99% de clasificación 
        correcta. Adicionalmente, los resultados obtenidos por usted son comparados con una 
        base de datos propia constituida por más de 7.200 personas que ya participaron en 
        este estudio.</p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">4 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 50px">
    <h2>MODELO KEMPEM: ATRIBUTOS ANALIZADOS</h2>
    <table>
        <tr>
            <th class="atributos head" width="15%">
                APRENDIZAJE AUTÓNOMO
            </th>
            <td class="atributos" width="85%">
                Facultad para tomar información conceptual y abstracta sobre dónde y cómo obtener recursos poco
                apreciados, tanto explícitos como tácitos y de cómo utilizarlos eficientemente.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                APROVECHAR OPORTUNIDADES
            </th>
            <td class="atributos">
                Acción subjetiva orientada a la capacidad de identificar nuevas combinaciones de recursos e información
                disponibles mediante la indagación constante en el medio ambiente y la observación de los cambios.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                AUTOEFICACIA
            </th>
            <td class="atributos">
                Creencia que tiene un individuo en su capacidad individual de perseguir y persistir para lograr un objetivo,
                incluso ante el escepticismo de los demás.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PENSAMIENTO CRÍTICO
            </th>
            <td class="atributos">
                Capacidad para realizar evaluaciones, juicios o tomar decisiones asociadas al análisis de una oportunidad, la
                creación de un negocio y su crecimiento, mediante el uso de modelos mentales simplificados orientados a
                unir información que previamente se encontraba inconexa.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                COMPETITIVIDAD
            </th>
            <td class="atributos">
                Acción-emoción compleja de un individuo que se encuentra involucrado de forma agresiva en una lucha
                crónica e incesante para alcanzar más en menos tiempo y que, de ser necesario, lo hará en contra de los
                esfuerzos opuestos de otras situaciones, medios o personas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LEGITIMIDAD
            </th>
            <td class="atributos">
                Manipulación deliberada del individuo y su proyecto, lo cual permite a los actores externos percibir una
                sensación de permanencia relativa del proyecto que se inicia.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                CREATIVIDAD E INNOVACIÓN
            </th>
            <td class="atributos">
                Patrón de comportamiento de un individuo que se encuentra interesado en crear el cambio y llevar
                adelante una dinámica que empuje al mercado sobre un modelo de desequilibrio que permita desarrollar,
                adquirir, construir o administrar nuevos productos, procesos, servicios, materias primas, y métodos de
                organización.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                DESARROLLO DE REDES DE CONTACTOS
            </th>
            <td class="atributos">
                Consiste en construir y transformar relaciones de naturaleza afectiva en relaciones de naturaleza
                instrumental, con la finalidad de adquirir confianza, ser más eficientes, promover el intercambio de
                recursos, proveer ideas, acceder a oportunidades de negocios privilegiadas y obtener el compromiso, ayuda
                y destrezas de los actores involucrados para materializar un proyecto o tarea y mejorar la innovación.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                CONFIANZA
            </th>
            <td class="atributos">
                Surge cuando los individuos son demasiado optimistas o irracionalmente confiados en el análisis que hacen
                de una situación, excediéndose en sus habilidades de estimación y no reconociendo la incertidumbre que
                realmente existe.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                EXPERIENCIA PREVIA
            </th>
            <td class="atributos">
                Conocimiento tácito adquirido a partir de las prácticas asociadas al aprendizaje del individuo, incluye
                experiencias laborales, profesionales, de startup, gerenciales y aquellas que son adquiridas por la relación
                con una industria específica.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                INCONFORMIDAD E INDIVIDUALISMO
            </th>
            <td class="atributos">
                Este comportamiento trae consigo ejecutar una serie de iniciativas que contribuyen a mejorar el entorno,
                implica pensar a título personal fuera de los márgenes establecidos para la generación de nuevos
                productos, procesos, servicios, mercados, proyectos o empresas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LIDERAZGO
            </th>
            <td class="atributos">
                Capacidad de definir una visión de lo que es posible y atraer a las personas para trabajar conjuntamente en
                ello, a fin de transformarla en realidad, facilitando esfuerzos individuales y colectivos para lograr un
                objetivo compartido.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LOCUS DE CONTROL INTERNO
            </th>
            <td class="atributos">
                Percepción de que las recompensas son consecuencia del comportamiento de un individuo, es decir, la
                capacidad percibida por los sujetos para influenciar directamente en los acontecimientos de sus vidas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                MOTIVACIÓN
            </th>
            <td class="atributos">
                Incentivo que conduce a las personas a realizar acciones específicas y que necesariamente debe ser
                intrínseco, bien, porque están motivados a lograr sus metas, porque disfrutan haciéndolo, porque obtienen
                satisfacción personal o porque la actividad es significativa en sí misma para ellos.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSISTENCIA
            </th>
            <td class="atributos">
                Continuidad de acciones que implican esfuerzo intenso durante largas y difíciles horas, sin importar los
                obstáculos que se presenten con el fin de cumplir los objetivos propuestos. El nivel de compromiso ayuda a
                los individuos a superar el cansancio y los fracasos para cumplir una meta.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSUASIÓN
            </th>
            <td class="atributos">
                Proceso de influir o convencer a las personas para cambiar su actitud o comportamiento con el fin de definir
                una visión de lo que es posible o de lo que se desea lograr.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                POSESIÓN DE INFORMACIÓN
            </th>
            <td class="atributos">
                Abarca todos aquellos datos, conceptos o teorías adquiridos previamente y que los individuos emplean
                durante el proceso de descubrimiento y aprovechamiento de oportunidades y la formación de nuevos
                negocios.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TENDENCIA A ASUMIR RIESGOS
            </th>
            <td class="atributos">
                Probabilidad percibida de recibir recompensas asociadas con el éxito de una situación específica y cuya
                alternativa provee menos recompensas, así como consecuencias menos severas.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TOLERANCIA AL FRACASO E INCERTIDUMBRE
            </th>
            <td class="atributos">
                Capacidad de aceptar que el fracaso es una técnica de aprendizaje que provee la oportunidad de
                diagnosticar por qué ha ocurrido un error, los fracasos proporcionan información para descubrir
                incertidumbres que anteriormente eran impredecibles.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TOMA DE DECISIONES Y SOLUCIÓN DE PROBLEMAS
            </th>
            <td class="atributos">
                Implica elegir entre efectos posibles de una acción empleando un conjunto de medios dados y, además,
                elegir el conjunto de medios para lograr un efecto deseado, es aplicado especialmente en situaciones
                donde no existen tendencias históricas, niveles anteriores de desempeño y poca o ninguna información
                específica, por ende, el futuro es altamente incierto y la naturaleza o características precisas de los
                objetivos no son conocidas con ningún grado de certeza.
            </td>
        </tr>
    </table>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">5 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin: 250px 100px 0px;">
        <h2>GUÍA PARA LA INTERPRETACIÓN <br>
        DE LOS RESULTADOS</h2>
        <table>
            <tr>
                <th width="10%">
                    <img src="<?= WWW_ROOT ?>/img/reporte/4.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td width="90%">
                    Lea con atención toda la información suministrada
                    en cada sección.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/5.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Revise detenidamente cada gráfico y su significado.
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
                    comportamiento típico ante las situaciones
                    planteadas en cada uno de los ítems.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/7.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Relacione sus comportamientos con los procesos
                    clave de su actividad y analice cómo impactan en
                    su desempeño presente y futuro.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/8.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Profundice en la comprensión del significado de
                    cada atributo y sus implicaciones para el logro
                    global de la competencia emprendedora.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/9.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Establezca planes de formación orientados a
                    trabajar sobre los atributos débiles.
                </td>
            </tr>
        </table>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">6 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 50px">
        <h2>RESULTADOS POR ATRIBUTOS</h2>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph2/'.$evaluation->id)) ?>" alt="">
        <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
        <div class="pagination">7 de 10</div>
        <p style="margin-top: 30px;">
        * El valor ideal representa la mayor puntuación en cada atributo obtenido 
        por emprendedores de alto perfil. Este ideal puede variar con la incorporación 
        de emprendedores con un nivel de desempeño más alto y se optimiza el algoritmo 
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
                    datos, hechos, conceptos, nociones, información, proposiciones y
                    categorías adquiridas en una o varias disciplinas mediante la
                    experiencia o el aprendizaje y que son necesarios para su adecuado
                    desempeño.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/11.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>HABILIDADES:</b> capacidad para actuar e intervenir en la realidad
                    mediante el uso de procedimientos o procesos necesarios para el
                    desempeño de cualquier actividad, física o mental.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/12.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>ACTITUDES Y VALORES:</b> consiste en la disposición y motivación del
                    individuo a la acción y a la puesta en práctica de los valores ante
                    situaciones profesionales y de la vida y tiene como base su
                    autonomía, autoestima y proyecto ético de vida. Además,
                    corresponde al sistema de creencias y disposiciones afectivas
                    estables que la persona asume como pautas referenciales para
                    actuar de una determinada manera.
                </td>
            </tr>
        </table>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph1/'.$evaluation->id)) ?>" alt="">
        <p style="margin-top: 30px;">
        * El valor ideal representa la mayor puntuación en cada dimensión obtenido 
        por emprendedores de alto perfil. Este ideal puede variar con la 
        incorporación de emprendedores con un nivel de desempeño más alto y se 
        optimiza el algoritmo en la medida que se vayan incrementando los datos. </p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">8 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>NIVEL DE MADUREZ DEL POTENCIAL EMPRENDEDOR</h2>
        <p>
        En el gráfico que se presenta a continuación, se han establecido tres niveles de 
        madurez para clasificar y jerarquizar el potencial emprendedor: Bajo, medio y 
        alto. Estos niveles están representados mediante los colores correspondientes 
        a un semáforo, para ayudarle a identificarlos de una forma familiar. 
        Es importante señalar que, tratándose del análisis de atributos personales, 
        encontrar un perfil puro no es lo más habitual, con lo cual es probable que 
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
        <h3 style="text-align: center;">Interpretación de los resultados:</h3>
        <table style="margin: 30px 150px;">
            <?php if($grafico < 3){ ?>
            <tr>
                <th width="20%" class="rojo">
                    Madurez Baja
                    De 0 a 3 puntos
                </th>
                <td width="80%" class="justificado">
                    Debe fortalecer su competencia emprendedora. Si realmente lo que desea
                    es emprender, aún le queda camino por recorrer y aunque en su perfil se
                    pueden encontrar atributos emprendedores, estos no son suficientes para
                    comenzar y gestionar un proyecto emprendedor individualmente. Intente
                    analizar las razones y tómese su tiempo para desarrollarse. Considere la
                    baja puntuación de su cuestionario como una oportunidad para reconocer y
                    reforzar aquellos atributos más débiles o complementarlos con otros
                    miembros de su equipo emprendedor. Recuerde que no es suficiente con
                    tener una buena idea, conocimientos del mercado o financiamiento, si
                    después no se está preparado para afrontar los retos permanentes que
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
                    Reúne muchas características para ser emprendedor. No obstante, debe
                    evaluar y fortalecer algunos de sus atributos. Analice esos puntos débiles y
                    fije una serie de acciones concretas para mejorarlos en un determinado
                    plazo. Afrontar la puesta en marcha de un proyecto emprendedor requiere
                    que la competencia emprendedora esté en un nivel mayor al obtenido.
                    Cuenta con la capacidad y visión para emprender, lo cual es un punto
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
                    bases sólidas para iniciar su camino hacia la ejecución de su
                    emprendimiento. Puede que requiera información o asesoramiento sobre
                    temas puntuales para poner su emprendimiento en marcha, pero ya tiene
                    el nivel de madurez suficiente para iniciarse como emprendedor. Ello no
                    quiere decir que ya tenga asegurado el éxito, pero sin duda los atributos
                    personales que posee son los necesarios para desempeñarse por encima de
                    los niveles promedios.
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">9 de 10</div>
</div>
<div class="page last-page">
    <div style="position: absolute; top: 30%; width: 100%; color: #ffffff">    
        <img class="centrado logo-final" src="<?= WWW_ROOT ?>/img/reporte/13.png" alt="">
        <h3 class="centrado">www.kempem.com</h3>
    </div>
</div>
