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
        <h1>RESULTS REPORT</h1>
        <h2><?= $evaluation->instrument->name ?></h2>
    </div>
    <div class="centrado" style="position: absolute; bottom: 100px; width: 100%;">
        <?= $evaluation->names ?> <?= $evaluation->lastnames ?><br>
        <?= $evaluation->sale->company->name ?><br>
        Completed <?= $evaluation->completed->i18nformat('dd/MM/YYYY') ?>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">1 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>TERMS AND CONDITIONS</h2>
        <p>
            This results report has been prepared by KEMPEM through a technological platform designed for this purpose. 
            In accordance with the terms and conditions that you accepted at the time of participating, we inform you that the 
            personal data provided and processed will be treated with strict confidentiality. In no way will they be shared, 
            transferred, sold, exchanged or used individually, without your express consent. Our model is governed by the 
            General Data Protection Regulation of the European Union (RGPD) and by national and international legislation on
             intellectual and industrial property. Except in the custom report, the results and analysis will never be publicly 
             displayed individually, only as a group. The researchers authorized to come into contact with your personal data 
             are committed to complying with the necessary technical and organizational precautions to guarantee the highest 
             possible level of security of your data and results. As a user, you have a strictly private and exclusive right of use, 
             in order to enjoy the benefits of the products and services provided by KEMPEM.
            </p>
            <p>
            KEMPEM reserves all intellectual and industrial property rights
            on trademarks, logos, distinctive signs, graphic design, theoretical models,
            dimensions, attributes and their combination, items, definitions, descriptions,
            graphs of results, models, processes and statistical analysis, analysis of
            data, measurement and data collection instruments, surveys, questionnaires,
            algorithms, design and structure of results reports, presentations, and
            literature related to the measurement and global analysis of competencies,
            attributes and personal, organizational, professional,
            executive, labor or entrepreneurial, and their objective individual and
            group, which have been developed unprecedentedly by KEMPEM as
            result of previous and ongoing research that has been carried out since
            2009. In no case shall it be understood that the use of products and
            services derived from our exchange give the user or the
            customer any right, nor does it imply a waiver, transfer, license or
            total or partial assignment of said rights by KEMPEM. </p>
            <p>
            It is prohibited to modify, copy, transform, reproduce, disclose or
             distribute in any way, in whole or in part, any of the elements
             intellectual and industrial property of KEMPEM, for public purposes,
             private and/or commercial. The use, disclosure or reproduction of
             this material or its content in whole or in part, unless you,
             as a user, is expressly authorized in writing by KEMPEM..</p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">2 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>CONTENT OF THIS REPORT OF RESULTS</h2>
        <img class="centrado" src="<?= WWW_ROOT ?>/img/reporte/3.png" style="width: 900px; position: relative; left: 50%; margin-left: -450px;" alt="">
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">3 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 150px">
        <h2>KEMPEM MODEL</h2>
        <p>
        Competencies are behaviors that some people master better than
         others, what makes them efficient in a given situation. Considering
         that entrepreneurship translates into behaviors, the approach based on
         competencies more precisely expresses those attributes necessary for
         generating such behaviors. What is entrepreneurial competition?
         What are its dimensions? What are its attributes?</p>
        <p>
        The KEMPEM Model is a validated and automated methodology that allows measuring
         and analyze 20 attributes of entrepreneurial competence grouped into 3
         dimensions: a) knowledge, b) skills, and c) attitudes and values);
         shows the current performance and maturity level of the potential entrepreneur.
         The validity and reliability of the methodology has been tested in several groups of
         interest: entrepreneurs, employees, managers and university students, from
         Several countries have even carried out some measurements on adolescents.</p>
        <p>
        We evaluate the attributes that condition entrepreneurial action in individuals,
        as well as effective ways to stimulate them. That is why, with a
        research started in 2009, we have defined, measured, analyzed and validated
        the attributes of the entrepreneur and their value in the creation, growth and
        business strengthening. This led us to develop methodologies, models
        theoretical and statistical analysis, algorithms and own instruments that allow
        identify, classify and prioritize the profile of the entrepreneur. To do
        analysis, artificial intelligence tools are used, specifically
        neural networks (deep learning) which evaluate without bias or intervention
        (unsupervised learning), current performance and predict performance
        person's future. KEMPEM involves several algorithm layers that work with
        large volumes of unstructured or labeled data that enable you to learn
        autonomously, with which as more data is entered, the system
        optimizes by becoming more effective and efficient.</p>
        <p>
        The model has a 95% confidence level for all its items; a precision in
         characterization of entrepreneurial potential above 98% and 99% classification
         correct. Additionally, the results obtained by you are compared with a
         own database made up of more than 7,200 people who have already participated in
         This studio.</p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">4 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 50px">
    <h2>KEMPEM MODEL: ATTRIBUTES ANALYZED</h2>
    <table>
        <tr>
            <th class="atributos head" width="15%">
                SELF LEARNING
            </th>
            <td class="atributos" width="85%">
                Ability to take conceptual and abstract information about where and how to obtain scarce resources
                 appreciated, both explicit and tacit, and how to use them efficiently.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                SEIZE OPPORTUNITIES
            </th>
            <td class="atributos">
                Subjective action oriented to the ability to identify new combinations of resources and information
                 available through constant inquiry into the environment and observation of changes.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                SELF-EFFICACY
            </th>
            <td class="atributos">
                Belief that an individual has in his or her individual ability to pursue and persist in order to achieve a goal,
                 even in the face of skepticism from others.
          </td>
        </tr>
        <tr>
            <th class="atributos head">
                CRITICAL THINKING
            </th>
            <td class="atributos">
                Ability to make evaluations, judgments or make decisions associated with the analysis of an opportunity, the
                 creation of a business and its growth, through the use of simplified mental models oriented to
                 unite information that was previously unconnected.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
               COMPETITIVENESS
            </th>
            <td class="atributos">
                Complex action-emotion of an individual who is aggressively involved in a fight
                 chronic and incessant to achieve more in less time and that, if necessary, will do so against the odds.
                 opposing efforts of other situations, media or people.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LEGITIMACY
            </th>
            <td class="atributos">
                Deliberate manipulation of the individual and his project, which allows external actors to perceive a
                 sense of relative permanence of the project that is being started.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                CREATIVITY AND INNOVATION
            </th>
            <td class="atributos">
                Behavioral pattern of an individual who is interested in creating change and leading
                 forward a dynamic that pushes the market on a model of imbalance that allows the development,
                 acquire, build, or manage new products, processes, services, raw materials, and production methods
                 organization.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                DEVELOPMENT OF CONTACT NETWORKS
            </th>
            <td class="atributos">
                It consists of building and transforming relationships of an affective nature into relationships of an emotional nature.
                 instrumental, in order to gain confidence, be more efficient, promote the exchange of
                 resources, provide ideas, access privileged business opportunities and obtain the commitment, help
                 and skills of the actors involved to materialize a project or task and improve innovation.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TRUST
            </th>
            <td class="atributos">
                It arises when individuals are overly optimistic or unreasonably confident in the analysis they make.
                 of a situation, exceeding their estimation skills and failing to recognize the uncertainty that
                 really exist.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PREVIOUS EXPERIENCE
            </th>
            <td class="atributos">
                Tacit knowledge acquired from the practices associated with the learning of the individual, includes
                 work, professional, startup, managerial experiences and those that are acquired by the relationship
                 with a specific industry.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                NONCONFORMITY AND INDIVIDUALISM
            </th>
            <td class="atributos">
                This behavior brings with it the execution of a series of initiatives that contribute to improving the environment,
                 implies thinking personally outside the margins established for the generation of new
                 products, processes, services, markets, projects or companies.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LEADERSHIP
            </th>
            <td class="atributos">
                Ability to define a vision of what is possible and engage people to work together on
                 this, in order to transform it into reality, facilitating individual and collective efforts to achieve a
                 shared goal.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                LOCUS OF INTERNAL CONTROL
            </th>
            <td class="atributos">
                Perception that rewards are a consequence of an individual's behavior, that is, the
                 ability perceived by subjects to directly influence events in their lives.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                MOTIVATION
            </th>
            <td class="atributos">
                Incentive that leads people to perform specific actions and that must necessarily be
                 intrinsic, well, because they are motivated to achieve their goals, because they enjoy doing it, because they get
                 personal satisfaction or because the activity is significant in itself for them.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSISTENCE
            </th>
            <td class="atributos">
                Continuity of actions that involve intense effort for long and difficult hours, regardless of the
                 obstacles that arise in order to meet the proposed objectives. The level of commitment helps
                 individuals to overcome fatigue and failures to meet a goal.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                PERSUASION
            </th>
            <td class="atributos">
                Process of influencing or convincing people to change their attitude or behavior in order to define
                 a vision of what is possible or what you want to achieve.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                POSSESSION OF INFORMATION
            </th>
            <td class="atributos">
                It encompasses all those data, concepts or theories previously acquired and that individuals use
                 during the process of discovering and taking advantage of opportunities and the formation of new
                 business.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TENDENCY TO TAKE RISKS
            </th>
            <td class="atributos">
                Perceived probability of receiving rewards associated with the success of a specific situation and whose
                 alternative provides fewer rewards as well as less severe consequences.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
                TOLERANCE FOR FAILURE AND UNCERTAINTY
            </th>
            <td class="atributos">
                Ability to accept that failure is a learning technique that provides the opportunity to
                 diagnose why an error has occurred, failures provide information to discover
                 uncertainties that were previously unpredictable.
            </td>
        </tr>
        <tr>
            <th class="atributos head">
               DECISION MAKING AND PROBLEM SOLVING
            </th>
            <td class="atributos">
                It involves choosing between possible effects of an action using a given set of means and, in addition,
                 choose the set of means to achieve a desired effect, it is applied especially in situations
                 where there are no historical trends, previous levels of performance and little or no information
                 therefore, the future is highly uncertain and the precise nature or characteristics of the
                 targets are not known with any degree of certainty.
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
        <h2>GUIDE TO INTERPRETATE <br>
        THE RESULTS</h2>
        <table>
            <tr>
                <th width="10%">
                    <img src="<?= WWW_ROOT ?>/img/reporte/4.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td width="90%">
                    Read carefully all the information provided
                     in each section.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/5.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Carefully review each chart and its meaning.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/6.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    There are no right or wrong answers. The
                     results obtained and expressed in this
                     report, represent what you consider your
                     typical behavior in situations
                     raised in each of the items.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/7.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Relate your behaviors to processes
                     key to your activity and analyze how they impact
                     their present and future performance.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/8.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Deepen your understanding of the meaning of
                     each attribute and its implications for achievement
                     global entrepreneurial competition.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/9.png" style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td>
                    Establish training plans aimed at
                     Work on weak attributes.
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
        <h2>RESULTS BY ATTRIBUTES</h2>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph2/'.$evaluation->id)) ?>" alt="">
        <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
        <div class="pagination">7 de 10</div>
        <p style="margin-top: 30px;">
        * The ideal value represents the highest score in each attribute obtained.
         by high-profile entrepreneurs. This ideal may vary with the incorporation
         of entrepreneurs with a higher level of performance and the algorithm is optimized
         as the data increases.
        </p>
    </div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 10px">
        <h2>RESULTS BY DIMENSIONS</h2>
        <table>
            <tr>
                <th width="15%">
                    <img src="<?= WWW_ROOT ?>/img/reporte/10.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td width="85%" class="justificado">
                    <b>KNOWLEDGE:</b> ability to mentally represent sets of
                     data, facts, concepts, notions, information, propositions and
                     categories acquired in one or several disciplines through the
                     experience or learning and that are necessary for its proper
                     performance.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/11.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>SKILLS:</b> ability to act and intervene in reality
                     through the use of procedures or processes necessary for the
                     performance of any activity, physical or mental.
                </td>
            </tr>
            <tr>
                <th>
                    <img src="<?= WWW_ROOT ?>/img/reporte/12.png"  style="margin: 20px 10px; width: 50px;" alt="">
                </th>
                <td class="justificado">
                    <b>ATTITUDES AND VALUES:</b> consists of the disposition and motivation of the
                     individual to action and the implementation of values before
                     professional and life situations and is based on their
                     autonomy, self-esteem and ethical project of life. What's more,
                     corresponds to the system of beliefs and affective dispositions
                     stable that the person assumes as referential guidelines for
                     act in a certain way.
                </td>
            </tr>
        </table>
        <img class="centrado" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph1/'.$evaluation->id)) ?>" alt="">
        <p style="margin-top: 30px;">
        * The ideal value represents the highest score in each dimension obtained.
         by high-profile entrepreneurs. This ideal may vary with the
         incorporation of entrepreneurs with a higher level of performance and
         optimizes the algorithm as the data increases. </p>
    </div>
    <div class="copyright">Copyright ® KEMPEM. All rights reserved. Prohibido su uso, divulgación y reproducción total o parcial</div>
    <div class="pagination">8 de 10</div>
</div>
<div class="page">
    <img src="<?= WWW_ROOT ?>/img/reporte/2.png" class="logo_page">
    <div style="margin-top: 100px">
        <h2>LEVEL OF MATURITY OF THE ENTREPRENEURIAL POTENTIAL</h2>
        <p>
        In the graph below, three levels of
         maturity to classify and rank entrepreneurial potential: Low, medium and
         high. These levels are represented by the corresponding colors
         to a traffic light, to help you identify them in a familiar way.
         It is important to point out that, in the case of the analysis of personal attributes,
         find a pure profile is not the most common, so it is likely that
         find themselves in mixed situations.</p>
        <table class="semaforo" style="width: 500px; position: relative; left: 50%; margin: 30px 0px 30px -250px; display: block;">
            <tr>
                <td class="rojo">
                    LOW MATURITY
                </td>
                <td class="amarillo">
                    MEDIUM MATURITY
                </td>
                <td class="verde">
                    HIGH MATURITY
                </td>
            </tr>
        </table>
        <h3 style="text-align: center;">The level of maturity of the potential entrepreneur:</h3>
        <img class="centrado" style="margin: 30px auto;" src="data: image/png;base64,<?= base64_encode(file_get_contents('https://'.(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"evaluaciones.kempem.com").'/graph3/'.$evaluation->id)) ?>" alt="">
        <h3 style="text-align: center;">Results analysis:</h3>
        <table style="margin: 30px 150px;">
            <?php if($grafico < 3){ ?>
            <tr>
                <th width="20%" class="rojo">
                    Madurez Baja
                    De 0 a 3 puntos
                </th>
                <td width="80%" class="justificado">
                    You must strengthen your entrepreneurial competence. If you really want
                     is to undertake, he still has a long way to go and although his profile shows
                     can find entrepreneurial attributes, these are not enough to
                     start and manage an entrepreneurial project individually. try
                     Analyze the reasons and take your time to develop. Consider the
                     low score on your quiz as an opportunity to recognize and
                     reinforce those weaker attributes or complement them with others
                     members of your entrepreneurial team. Remember that it is not enough
                     have a good idea, knowledge of the market or financing, if
                     then you are not prepared to face the permanent challenges that
                     It means starting a business.
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
                    You have many characteristics to be an entrepreneur. However, you must
                     evaluate and strengthen some of its attributes. Analyze those weak points and
                     set a series of concrete actions to improve them in a certain
                     term. Facing the start-up of an entrepreneurial project requires
                     that the entrepreneurial competence is at a higher level than the one obtained.
                     It has the capacity and vision to undertake, which is a point
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
                    You Show sufficient attributes to be an excellent entrepreneur. Are
                     qualities together with the proper development of your project, are
                     solid foundations to start your path towards the execution of your
                     entrepreneurship. You may require information or advice on
                     specific issues to start your business, but you already have
                     the level of maturity sufficient to start as an entrepreneur. It doesn't
                     means that success is already assured, but without a doubt the attributes
                     personal assets that he possesses are those necessary to perform above
                     the average levels.
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
