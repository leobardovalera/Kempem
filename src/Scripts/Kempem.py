#!/usr/bin/env python3
# coding: utf-8

# # Proceso de clasificación y jerarquización de individuos según instrumento para medir competencias según las dimensiones del Modelo KEMPEM

# ## DIMENSIÓN CONOCIMIENTOS

# Se cargan las librerias necesarias para realizar los calculos necesarios.
import pandas as pd
import numpy as np
import sys
from numpy import array
import math

# ### Se carga la base de datos inicial con las respuestas de los itemes (BD cruda MAMS)
usuario_csv = str(sys.argv[1])
path = str(sys.argv[2])

usuario          = pd.read_csv(f"{path}/files/{usuario_csv}_input.csv", header = None)
Preguntas_P13_P159_name = [ f'p{i}' for i in range(13,160)]
usuario.columns = Preguntas_P13_P159_name

# Preguntas asociadas al conocimiento
Preguntas_P13_P39_name = [ f'p{i}' for i in range(13,40)]


usuario_conocimiento = usuario[Preguntas_P13_P39_name].values

Table2_matrix =  [[-0.07499873,  0.35064861, -0.03159762, -0.00580622],
       [-0.06231151,  0.35141637, -0.01904179,  0.01693202],
       [-0.06436566,  0.35208437, -0.01492034,  0.02647679],
       [-0.08451436,  0.35228393, -0.02005545,  0.00167825],
       [-0.21301727,  0.02734531,  0.03463911,  0.18907224],
       [-0.20635758,  0.00131463,  0.02282543,  0.37223716],
       [-0.18826377, -0.01495148,  0.01844979,  0.48891059],
       [-0.20476162,  0.00577605, -0.01326829,  0.31777667],
       [-0.23309859,  0.03212911,  0.00247591,  0.07395976],
       [-0.20375046, -0.00239015,  0.01706092,  0.21498903],
       [-0.21845817,  0.02761147,  0.03005873,  0.04486695],
       [-0.2293088 ,  0.04345616,  0.0399865 , -0.05548623],
       [-0.19620038,  0.26001987,  0.03766261, -0.08733707],
       [-0.21000456,  0.25616548,  0.02767736, -0.14802883],
       [-0.19530213,  0.25013606,  0.06133454, -0.20493718],
       [-0.19721073,  0.24576124,  0.03676381, -0.22456392],
       [-0.2393301 , -0.16420854,  0.00392556, -0.1444724 ],
       [-0.22241654, -0.19512437,  0.02214713, -0.0978055 ],
       [-0.23829289, -0.17426323, -0.01726401, -0.12237194],
       [-0.23954467, -0.17636383, -0.00866492, -0.08175013],
       [-0.23886138, -0.17749074, -0.00780977, -0.1016015 ],
       [-0.25094067, -0.16177739, -0.01048429, -0.09681265],
       [-0.24977534, -0.15481232,  0.01976512, -0.12100773],
       [-0.22343813, -0.18884361,  0.03925135, -0.05632027],
       [-0.04915975, -0.0182158 , -0.56026727, -0.3650176 ],
       [-0.03435719,  0.01841137, -0.597223  ,  0.06536954],
       [-0.03522385,  0.01036767, -0.55867986,  0.28068341]]

Ideal = pd.DataFrame([4.826942, 4.753233, 4.710952, 4.658552])
Ideal.columns= ['Ideal']



#usuario_puntuacion_conocimiento = np.matmul(usuario_conocimiento, Table2_matrix)
#usuario_puntuacion_conocimiento = np.minimum(0.9*Ideal['Ideal'].values,5*(np.arctan(6*usuario_puntuacion_conocimiento)+math.pi/2)/math.pi)
#usuario_conocimiento_scoring    = 2*usuario_puntuacion_conocimiento.mean(axis=1)[0]

media_conocimiento = [3.111144533,3.100165438,3.076402467,3.118965258,3.982403369,3.925251918,3.908708076,3.974432245,4.021657392,3.922544744,3.977741014,4.025567755,2.835163182,2.896074598,2.787938036,2.841931117,4.761016694,4.73018499,4.797864341,4.815460972,4.812904196,4.840427132,4.877876372,4.785832456,4.98751692,5.018649421,5.044668371]
estandar_conocimiento = [1.61292091, 1.57977257, 1.5716534 , 1.61189632, 1.33267176, 1.29284864, 1.27337269, 1.28267484, 1.3725915 , 1.3257783 , 1.34456978, 1.35254215, 1.67147346, 1.81272692, 1.69815291,1.77506418, 1.8220824 , 1.75001942, 1.75775442, 1.78594975, 1.78715722, 1.83960038, 1.79603938, 1.76615057, 1.45902539, 1.40555496, 1.38670266]
    # Se le resta la media al usuario
usuario_conocimiento = (usuario_conocimiento - media_conocimiento)/estandar_conocimiento

usuario_puntuacion_conocimiento = np.matmul(usuario_conocimiento, Table2_matrix)
#usuario_puntuacion_conocimiento = np.minimum(0.9*Ideal['Ideal'].values,5*(np.arctan(6*usuario_puntuacion_conocimiento)+math.pi/2)/math.pi)
    
usuario_puntuacion_conocimiento = usuario_puntuacion_conocimiento[0] 
#usuario_puntuacion_conocimiento[0] = min(1.27*(4*np.exp(0.5*usuario_puntuacion_conocimiento[0])/(np.exp(0.5*usuario_puntuacion_conocimiento[0])+1)+1), 0.9*4.82)
usuario_puntuacion_conocimiento[0] = 4*np.exp(0.5*usuario_puntuacion_conocimiento[0])/(np.exp(0.5*usuario_puntuacion_conocimiento[0])+1)+1

#usuario_puntuacion_conocimiento[1] = min(4*np.exp(usuario_puntuacion_conocimiento[1])/(np.exp(usuario_puntuacion_conocimiento[1])+1)+1, 0.9*4.75)
usuario_puntuacion_conocimiento[1] = 4*np.exp(usuario_puntuacion_conocimiento[1])/(np.exp(usuario_puntuacion_conocimiento[1])+1)+1

#usuario_puntuacion_conocimiento[2] = min(4*np.exp(usuario_puntuacion_conocimiento[2])/(np.exp(usuario_puntuacion_conocimiento[2])+1)+1, 0.9*4.71)
usuario_puntuacion_conocimiento[2] = 4*np.exp(usuario_puntuacion_conocimiento[2])/(np.exp(usuario_puntuacion_conocimiento[2])+1)+1

#usuario_puntuacion_conocimiento[3] = min(4*np.exp(usuario_puntuacion_conocimiento[3])/(np.exp(usuario_puntuacion_conocimiento[3])+1)+1, 0.9*4.65)
usuario_puntuacion_conocimiento[3] = 4*np.exp(usuario_puntuacion_conocimiento[3])/(np.exp(usuario_puntuacion_conocimiento[3])+1)+1

usuario_conocimiento_scoring    = 2*usuario_puntuacion_conocimiento.mean()

conocimiento_ideal = 9.82
Ideal['Usuario'] = pd.DataFrame(usuario_puntuacion_conocimiento.transpose())
Ideal.index = ['Experiencia previa','Aprendizaje autónomo','Posesión de información','Pensamiento crítico']

# Imprimir los resultados de la dimension conocimiento
output_file     = open(f"{path}/files/{usuario_csv}_output.csv", 'w')
output_file.write(f"Conocimiento:{round(usuario_conocimiento_scoring,2)}")

output_file.write(f"\n")
output_file.write(f"Ideal_Conocimiento:{round(conocimiento_ideal,2)}")
output_file.write(f"\n")

# ## DIMENSIÓN Habilidades

# Preguntas asociadas al Habilidades
Preguntas_P40_P82_name = [ f'p{i}' for i in range(40,83)]

usuario_habilidades = usuario[Preguntas_P40_P82_name].values

Table6_matrix = [[ 1.97205541e-01,  2.26240708e-02, -6.06936267e-02,
         2.62294202e-03, -1.39915543e-01,  1.80648695e-02],
       [ 2.17948927e-01, -8.07218243e-03, -5.71775494e-02,
        -3.24716591e-02,  5.83536130e-02,  3.38679840e-02],
       [ 2.24685140e-01, -4.30140288e-02, -4.16022349e-02,
        -5.09339542e-02, -5.58447069e-02,  9.77923485e-02],
       [ 2.28677801e-01, -8.01069578e-02, -3.99972890e-02,
        -5.20446581e-02,  2.25794109e-02,  5.23577438e-02],
       [ 2.31426670e-01, -7.48245285e-02, -3.15416684e-02,
        -4.38593117e-02,  2.16947026e-02,  7.66483083e-02],
       [ 2.31811138e-01, -7.86552489e-02, -4.46833818e-02,
        -6.38253722e-02,  2.49699277e-02,  5.23152808e-02],
       [ 2.27896224e-01, -8.65231880e-02, -4.13029709e-02,
        -7.68853825e-02,  2.52012562e-02, -1.82114496e-02],
       [ 2.29579719e-01, -6.88975383e-02, -4.20679864e-02,
        -8.76492873e-02, -3.68214754e-02,  3.48776246e-03],
       [ 2.30745403e-01, -7.95567968e-02, -3.54001134e-02,
        -3.48936783e-02, -3.68233133e-02,  6.59554583e-02],
       [ 2.17685354e-01, -7.92607780e-03, -5.67760955e-02,
        -1.60531099e-02, -1.21693309e-02,  4.41820112e-02],
       [ 2.16746752e-01, -7.31329696e-05, -5.39448460e-02,
        -3.53301356e-02,  1.53386330e-02, -9.34589038e-02],
       [ 1.96097735e-01,  1.09958741e-02, -7.21617645e-02,
         1.59444083e-02, -4.20916928e-02, -3.81746000e-02],
       [ 1.78784630e-01,  6.94101541e-02, -7.54019244e-02,
         6.84111330e-02, -1.76933299e-01, -6.72363561e-02],
       [ 2.04481242e-01, -2.30418635e-02, -6.00231263e-02,
         4.50831001e-03, -4.83596347e-02, -3.82726307e-02],
       [ 2.05247665e-01, -1.56629477e-02, -5.25931763e-02,
        -2.55281032e-02, -3.29999049e-02, -8.00730417e-03],
       [ 1.99831558e-01, -2.05137493e-02, -4.91223136e-02,
        -4.41191298e-02,  7.61370103e-03,  1.73521914e-02],
       [ 2.03668261e-01, -1.50188001e-02, -7.15415597e-02,
        -1.07986859e-02, -2.37459892e-02, -3.38083234e-02],
       [ 1.89307766e-01,  4.55244167e-02, -1.00771733e-01,
        -4.94854985e-02, -6.06669000e-03, -5.70129318e-03],
       [ 1.83131469e-01,  4.68291391e-02, -1.05408365e-01,
         1.37659473e-02,  5.09278770e-03, -3.38494872e-02],
       [ 1.59170401e-01,  1.12110220e-01, -1.17878091e-01,
         4.40419851e-02,  7.88434814e-02, -7.24957997e-02],
       [ 5.98060987e-02,  3.75454482e-01, -1.50190874e-01,
         1.47554244e-01,  3.88881097e-02, -1.97007199e-02],
       [ 5.71852228e-02,  3.85791512e-01, -1.44641380e-01,
         1.19110925e-01,  1.01437184e-01, -4.56050177e-02],
       [ 1.35372319e-02,  4.16677016e-01, -1.22634815e-01,
         2.00989780e-01,  1.01280759e-01,  1.04986250e-01],
       [ 8.45776254e-02,  3.03527918e-01, -1.58587454e-01,
         1.59127124e-01,  2.16350198e-01, -2.34473516e-02],
       [-8.13922537e-02,  4.80997079e-02, -1.61536302e-01,
         5.69201870e-02,  2.62843819e-01,  2.22911029e-01],
       [-9.47609436e-02,  7.47819894e-02, -2.36511481e-01,
        -1.44773949e-01,  1.41815431e-01,  1.22327646e-01],
       [-1.00476893e-01,  6.26793198e-02, -2.31691366e-01,
        -1.63743394e-01,  1.16067734e-01,  1.34596504e-02],
       [-1.09866301e-01,  5.98869031e-02, -2.41864527e-01,
        -1.87433849e-01, -7.62319296e-02, -1.00935095e-01],
       [-9.61467771e-02, -1.17018547e-02, -2.39570172e-01,
        -2.88815568e-01,  2.99475172e-02, -4.74885709e-02],
       [-9.22388277e-02, -2.45629439e-02, -2.53053985e-01,
        -3.57024979e-01,  1.28857538e-02, -1.01111690e-01],
       [-1.13338877e-01,  6.63381392e-02, -2.53649244e-01,
        -2.48679665e-01, -4.44493515e-02, -1.04494210e-01],
       [-1.09231394e-01,  6.00619567e-02, -2.56687096e-01,
        -1.21476259e-01, -4.39592068e-03,  3.78321459e-02],
       [-7.35792171e-02, -7.32602851e-02, -2.38486666e-01,
        -2.34251405e-01, -2.76093634e-01,  1.44754631e-01],
       [-5.59614015e-02, -7.99784234e-02, -2.30055850e-01,
         9.67558779e-02, -4.24904962e-01,  2.95436438e-01],
       [-9.94633607e-02,  2.09107572e-02, -1.80630216e-01,
         3.27136283e-01, -3.23176999e-01,  3.36657964e-01],
       [-4.17961304e-02, -1.43238650e-01, -1.98617877e-01,
         3.07957054e-01, -1.09796143e-01,  1.00611728e-01],
       [-4.64670654e-02, -1.02209766e-01, -2.04522902e-01,
         2.80886523e-01, -1.75614879e-01, -2.67597553e-01],
       [-4.39864815e-02, -1.76015275e-01, -2.06822669e-01,
         1.94049369e-01,  8.62416022e-03, -4.54790525e-01],
       [-4.06029103e-02, -1.70757013e-01, -2.00434663e-01,
         2.38794352e-01,  1.14448382e-02, -4.24079818e-01],
       [-3.66413503e-03, -2.80175122e-01, -1.59772704e-01,
         1.09664019e-01,  9.70931644e-02,  5.37314832e-03],
       [-1.52475061e-03, -2.80306485e-01, -1.38155941e-01,
         6.70176983e-02,  3.16837230e-01,  4.91317731e-02],
       [-1.49372441e-02, -2.24547648e-01, -1.44123111e-01,
         1.33996622e-01,  4.42034971e-01,  1.76433223e-01],
       [-1.23480799e-02, -2.16873595e-01, -1.19710328e-01,
         9.81570146e-02,  1.87694628e-01,  3.30752629e-01]]

media_habilidades = [3.923898331,3.962400361,4.015942247,4.041209204,4.017145435,4.060911415,4.027823733,4.086930365,4.04587156,3.95307565,3.962400361,4.203188449,4.167543992,4.253421567,4.259136712,4.246804031,4.250263197,4.186644608,4.164235223,4.104075801,3.881034742,3.859828546,3.814257783,3.949466085,5.174311927,5.143480223,5.117611671,5.114302903,5.155361709,5.168145586,5.128590766,5.148443375,5.200932471,5.224244247,5.15836968,5.263799068,5.228906602,5.25733193,5.283050083,5.370431644,5.36667168,5.362610919,5.377951572]
    
# Se le divide la desviacion estandar
estandar_habilidades = [1.77729244, 1.76698395, 1.79308364, 1.85746245, 1.87981413, 1.84468905, 1.83313583, 1.84564381, 1.85309646, 1.76795242, 1.7474668 , 1.44288017, 1.43246251, 1.49397026, 1.49339236, 1.49407145, 1.49827227, 1.47641782, 1.47301515, 1.46211584, 1.49833936, 1.49242775, 1.58861815, 1.40979365, 1.36313928, 1.41342199, 1.42765932, 1.45371478, 1.32199477, 1.33791406, 1.32906139, 1.339626  , 1.29131799, 1.26929464, 1.29600868, 1.2992    , 1.2958559 , 1.29115203, 1.245769  , 1.29463782, 1.28269835, 1.30793797, 1.26588628]

# Se le resta la media
usuario_habilidades = (usuario_habilidades - media_habilidades)/estandar_habilidades

Hab = pd.DataFrame([4.796937, 4.791136, 4.888132, 4.805802, 4.758982, 4.830064])
Hab.columns= ['Ideal']

usuario_puntuacion_habilidades = np.matmul(usuario_habilidades, Table6_matrix)


usuario_puntuacion_habilidades=usuario_puntuacion_habilidades[0]
#usuario_puntuacion_habilidades[0] = min(4*np.exp(0.5*usuario_puntuacion_habilidades[0])/(np.exp(0.5*usuario_puntuacion_habilidades[0])+1)+1, 0.9*4.79)
usuario_puntuacion_habilidades[0] = 4*np.exp(usuario_puntuacion_habilidades[0])/(np.exp(usuario_puntuacion_habilidades[0])+1)+1

#usuario_puntuacion_habilidades[1] = min(4*np.exp(usuario_puntuacion_habilidades[1])/(np.exp(usuario_puntuacion_habilidades[1])+1)+1, 0.9*4.79)
usuario_puntuacion_habilidades[1] = 4*np.exp(usuario_puntuacion_habilidades[1])/(np.exp(usuario_puntuacion_habilidades[1])+1)+1

#usuario_puntuacion_habilidades[2] = min(1.27*(4*np.exp(usuario_puntuacion_habilidades[2])/(np.exp(usuario_puntuacion_habilidades[2])+1)+1),0.9*4.88)
usuario_puntuacion_habilidades[2] = 4*np.exp(usuario_puntuacion_habilidades[2])/(np.exp(usuario_puntuacion_habilidades[2])+1)+1

#usuario_puntuacion_habilidades[3] = min(4*np.exp(usuario_puntuacion_habilidades[3])/(np.exp(usuario_puntuacion_habilidades[3])+1)+1, 0.9*4.80)
usuario_puntuacion_habilidades[3] = 4*np.exp(usuario_puntuacion_habilidades[3])/(np.exp(usuario_puntuacion_habilidades[3])+1)+1

#usuario_puntuacion_habilidades[4] = min(4*np.exp(usuario_puntuacion_habilidades[4])/(np.exp(usuario_puntuacion_habilidades[4])+1)+1, 0.9*4.75)
usuario_puntuacion_habilidades[4] = 4*np.exp(usuario_puntuacion_habilidades[4])/(np.exp(usuario_puntuacion_habilidades[4])+1)+1

#usuario_puntuacion_habilidades[5] = min(4*np.exp(usuario_puntuacion_habilidades[5])/(np.exp(usuario_puntuacion_habilidades[5])+1)+1, 0.9*4.83)
usuario_puntuacion_habilidades[5] = 4*np.exp(usuario_puntuacion_habilidades[5])/(np.exp(usuario_puntuacion_habilidades[5])+1)+1

usuario_habilidades_scoring    = 2*usuario_puntuacion_habilidades.mean()

habilidades_ideal = 9.88


Hab['Usuario'] = pd.DataFrame(usuario_puntuacion_habilidades.transpose())
Hab.index = ['Aprovechar oportunidades',
               'Desarrollo de redes de contactos ','Toma de decisiones y solución de problemas ','Persuasión ',
               'Creatividad e innovación','Liderazgo ']

# Concatenar las dos Dataframes (Conocimiento y Habilidades)
Ideal  = Ideal.append(Hab)

# Imprimir los resultados de la dimension Habilidades
output_file.write(f"Habilidades:{round(usuario_habilidades_scoring,2)}")

output_file.write(f"\n")
output_file.write(f"Ideal_Habilidades:{round(habilidades_ideal,2)}")
output_file.write(f"\n")

# ## DIMENSIÓN Actitudes y Valores
# Preguntas asociadas al Actitudes y Valores
Preguntas_P83_P159_name = [ f'p{i}' for i in range(83,160)]


usuario_actitudes = usuario[Preguntas_P83_P159_name].values

Table10_matrix =  [[-9.76330885e-02, -9.48913716e-02, -5.80637919e-02,
         3.19772395e-02, -6.54466268e-02,  1.88763741e-01,
        -1.35893305e-01, -3.70849026e-03,  4.58993283e-02,
        -5.07793260e-02],
       [-8.41431479e-02, -4.01405542e-02, -1.15178697e-01,
         3.46262098e-02, -2.03546267e-02,  3.53499144e-01,
        -1.86496070e-01, -3.34755174e-02,  3.19487501e-03,
        -2.15230380e-02],
       [-9.01160252e-02, -3.12092634e-02, -1.10908709e-01,
         1.01662756e-01, -1.63672633e-02,  1.41431348e-01,
        -2.88583952e-01, -1.05169467e-01, -6.43684462e-02,
        -1.03909495e-01],
       [-8.45445826e-02,  4.78758188e-03, -1.58507964e-01,
         7.36414112e-02, -5.54616303e-02,  3.37068850e-01,
        -1.64882093e-01, -5.92802736e-02, -8.78228490e-02,
         2.10924245e-01],
       [ 4.21617996e-02, -9.02856930e-02, -1.49694392e-01,
         1.63699931e-01, -1.47935128e-01,  1.22074312e-01,
        -1.37573442e-01,  3.87900718e-02, -1.92397778e-01,
         2.11461034e-01],
       [ 4.17419122e-02, -8.07497143e-02, -1.55978415e-01,
         1.95959761e-01, -1.09746340e-01,  1.68028212e-01,
        -3.59962435e-02, -6.74725030e-02, -1.05946460e-01,
        -1.43964123e-02],
       [ 4.19394082e-02, -3.70982222e-02, -1.90790000e-01,
         1.77732818e-01, -1.01518173e-01,  1.50077573e-01,
         2.15198212e-03,  1.09588173e-01,  1.08101953e-01,
         3.33380469e-02],
       [ 4.96547362e-02, -8.58616681e-02, -1.42724427e-01,
         2.15925833e-01, -8.70051911e-02,  1.08538209e-01,
         6.57164189e-02,  1.69535977e-01,  1.62182372e-01,
         8.90820650e-02],
       [ 4.40157740e-02, -3.75509473e-02, -1.88110709e-01,
         1.92901192e-01, -3.83038074e-02,  1.05783804e-01,
         1.49225283e-01, -7.97112800e-02,  2.41040039e-01,
        -5.74749143e-05],
       [ 4.33475120e-02,  5.34129332e-03, -2.05643836e-01,
         1.76187094e-01, -1.49048937e-02,  1.35347234e-01,
         6.24154498e-02, -5.47090009e-03,  2.54722961e-01,
        -1.56985011e-01],
       [ 2.12558735e-01, -1.00788646e-01, -1.34624612e-01,
         1.80375775e-01, -9.07621204e-02, -1.86427073e-02,
         1.75963666e-02,  2.34872439e-02,  6.95444611e-02,
        -3.84617469e-02],
       [ 7.49617181e-02, -1.95428946e-01, -1.13663197e-01,
         1.39826101e-02,  2.11045782e-01, -1.24534333e-02,
        -2.09656810e-02,  6.64572477e-02,  1.66415663e-01,
         7.07546243e-02],
       [ 7.12124823e-02, -1.79728790e-01, -9.91826070e-02,
        -1.40195383e-01,  2.55249851e-01,  7.96154898e-02,
        -1.71492286e-02,  1.36023434e-01,  4.68721161e-02,
         8.16526961e-02],
       [-6.77910369e-02, -5.99301535e-02, -1.18153442e-01,
        -9.50047456e-02,  4.18707239e-01,  2.75586920e-01,
         1.28425465e-02, -1.69248285e-02,  7.32349761e-02,
        -1.21854910e-02],
       [-7.25526420e-02, -5.61959824e-02, -5.62895756e-02,
        -2.30303628e-01,  3.54532746e-01,  1.81991121e-01,
        -2.43526202e-02,  1.49646774e-01, -4.82850013e-02,
        -2.47197222e-02],
       [-1.71426750e-02, -1.24296067e-01,  2.41815960e-02,
        -2.91227082e-01, -1.80581042e-01,  9.09536000e-02,
         7.16112866e-02,  2.28125234e-01,  1.20962723e-01,
         1.39094563e-01],
       [-9.14993136e-03, -1.32867902e-01,  3.03252558e-02,
        -1.96474956e-01, -1.92160163e-01,  3.91811091e-02,
         1.51357411e-01,  1.62924408e-01,  1.86232122e-01,
         8.07236342e-02],
       [-9.14655471e-03, -1.22159334e-01, -2.12818150e-03,
        -8.83813802e-02, -3.74899900e-02,  3.32025733e-02,
         1.66765965e-01,  1.10930553e-01,  6.99244819e-02,
         7.47103657e-02],
       [ 1.38810433e-03, -1.28580524e-01, -1.56611998e-02,
        -1.23288302e-01, -7.13987095e-02,  6.25733958e-02,
         1.32302835e-01, -4.33822559e-02, -6.48772796e-02,
         5.86219900e-02],
       [ 4.28981478e-04, -9.47225320e-02,  7.89019989e-03,
        -2.53224416e-01, -2.06825385e-01,  3.61543799e-02,
        -1.88238986e-02,  5.31925183e-02,  1.32783638e-01,
        -9.45138002e-02],
       [-1.63193603e-02, -1.42688443e-01,  7.23296489e-02,
        -2.22247758e-01, -2.05647244e-01,  8.72893428e-02,
        -2.55316661e-02, -1.18706460e-01,  1.96718898e-01,
        -2.68677210e-02],
       [ 4.59161053e-03,  2.42289767e-02, -8.30625245e-02,
        -2.41904663e-01, -9.74107461e-02,  4.15105973e-02,
        -1.26165335e-01, -1.14164352e-01,  2.98818609e-01,
        -1.56772628e-02],
       [-1.01792724e-02, -1.72913448e-01,  4.22488638e-02,
        -1.51135375e-01, -1.34907358e-01,  2.56281297e-02,
         9.52001897e-02, -1.36951948e-01,  7.29429308e-02,
        -8.94299962e-02],
       [ 4.44686297e-03,  4.52187380e-03, -9.90855848e-02,
        -1.24127010e-01, -4.78020931e-02,  7.64776226e-02,
        -1.36336341e-01, -3.69382504e-01,  1.18605153e-01,
        -1.63512643e-01],
       [ 3.80375803e-05, -1.62081433e-01,  5.17258931e-02,
        -1.04189099e-01, -1.49087586e-01,  3.83457267e-02,
        -1.18087353e-02, -1.32354198e-01,  8.06523796e-03,
        -1.75847181e-02],
       [-8.61667018e-03, -1.64240981e-01, -1.30231041e-02,
        -8.31709777e-02, -1.68840600e-02,  7.93608901e-02,
         1.37452574e-01, -5.19569739e-02,  3.92739111e-02,
         3.51535693e-02],
       [-1.33859542e-03, -2.00102457e-01,  1.99382069e-02,
         9.59900130e-03, -4.61695286e-02,  3.14851260e-02,
         6.99527848e-02, -2.15795550e-01, -1.29621575e-01,
        -1.16757476e-01],
       [ 9.30119381e-03, -1.72357145e-01, -1.42223347e-02,
         2.67802821e-02, -7.47890616e-02,  6.61614128e-02,
         9.64162255e-03, -2.36992471e-01, -8.47098417e-02,
         1.24673127e-01],
       [ 7.55443515e-03, -1.78935159e-01, -8.71537302e-03,
         1.20985907e-02,  3.00464170e-02,  4.64961605e-02,
         4.64250948e-02, -7.44961961e-02, -1.45861418e-01,
        -1.37672402e-01],
       [ 1.82126933e-02, -1.13964369e-01, -5.66269338e-02,
        -1.12031236e-03,  9.15943003e-02, -7.40959118e-02,
        -2.20157623e-03, -1.47894679e-01, -2.89501805e-02,
        -2.39874499e-01],
       [ 6.55210560e-03, -1.70043498e-01,  3.72261183e-03,
        -2.97014339e-02,  1.22528606e-01, -1.12248185e-01,
         1.08101277e-02, -2.83324334e-01, -1.11235000e-01,
         6.35549627e-03],
       [ 1.01897642e-02, -1.48165139e-01, -3.13304091e-02,
         1.84622518e-02,  1.10338701e-01, -5.22236643e-02,
         1.12378679e-01, -1.39925530e-01, -2.20102038e-02,
        -2.83631316e-02],
       [ 2.01502111e-02, -1.41963583e-01,  7.36875483e-04,
         3.52343120e-02,  6.97586416e-02, -1.83937983e-01,
        -8.79194085e-02, -2.24198883e-01,  7.61953813e-02,
         7.48612573e-03],
       [ 2.28473153e-02,  1.51637269e-02, -1.46078670e-01,
         7.28132823e-02,  1.86060564e-01, -1.56293435e-01,
         6.64688018e-02, -1.36368802e-01,  2.15289199e-01,
         1.58481285e-02],
       [ 8.07685557e-03, -7.67958593e-02, -5.58545946e-02,
         4.39333398e-02,  1.11067488e-01, -1.11200124e-01,
         5.92511696e-02, -1.79087930e-01,  1.99429721e-01,
         4.11608448e-01],
       [ 4.65213330e-03, -7.07859171e-02, -6.92785344e-02,
        -5.57018578e-02,  1.67974635e-01, -9.93915856e-02,
        -7.93949889e-02, -1.30755290e-01,  9.22670148e-02,
         2.22225855e-01],
       [ 1.70618725e-02, -1.52900096e-02, -8.88798290e-02,
        -1.30091736e-01,  1.31516806e-03, -1.63334637e-01,
        -1.42035462e-01, -1.50263861e-01,  6.44816318e-02,
         1.78368261e-01],
       [ 1.66320859e-01,  3.29950493e-02, -2.13153563e-01,
        -1.05629643e-01, -3.82690811e-02, -1.31421257e-01,
        -6.76303463e-02,  1.86156864e-02, -5.34739192e-02,
         8.92844742e-02],
       [ 1.72560695e-01,  9.82026415e-02, -2.45905707e-01,
        -1.29092373e-01, -1.76210608e-02, -9.20112146e-02,
        -3.54590598e-02, -1.00937879e-02, -7.43513509e-02,
         1.32743921e-02],
       [ 1.64276504e-01,  9.30547661e-02, -2.52383554e-01,
        -1.07906411e-01, -2.15361137e-02, -8.41866927e-02,
        -3.34747996e-02,  4.42667899e-02, -6.89296291e-02,
         2.18352176e-02],
       [ 1.67059490e-01,  9.56763152e-02, -2.49926691e-01,
        -1.07962421e-01, -2.74833036e-02, -4.53645997e-02,
         2.07124214e-02,  4.26098774e-02, -1.17728032e-01,
        -4.66395954e-02],
       [ 1.69529270e-01,  9.25458660e-02, -2.59117351e-01,
        -1.10766172e-01, -2.02365768e-02, -5.69047795e-02,
         4.09406081e-02, -2.05221874e-02, -6.04452198e-02,
        -1.66205101e-02],
       [ 1.66178483e-01,  9.15061864e-02, -2.60651407e-01,
        -1.16988118e-01, -2.37429161e-02, -6.18490807e-02,
        -1.18507126e-04,  1.64878776e-02, -7.49113696e-02,
        -2.61797573e-02],
       [ 1.65179656e-01, -3.92661503e-02, -1.69744591e-01,
        -1.38596441e-01, -6.63628117e-02, -3.98869416e-02,
         6.07229271e-02,  2.28834346e-02, -1.44303359e-01,
        -1.02320668e-01],
       [ 1.49250402e-01, -1.08563598e-01, -1.31189953e-01,
        -1.33876793e-01, -6.99028148e-02, -3.38170858e-02,
         4.50679269e-02,  7.90213474e-02, -1.83873579e-01,
        -1.62865082e-01],
       [-1.68456446e-01,  1.09222168e-01, -1.27119647e-01,
        -2.41105198e-01,  1.48871370e-01,  1.15954294e-01,
         5.71499230e-02,  1.41629208e-02, -8.71704186e-02,
        -7.41571446e-02],
       [-1.52344904e-01,  9.68608359e-02, -1.61692383e-01,
        -2.11679542e-02, -2.90099790e-02, -1.68071487e-02,
         1.46896268e-01,  2.11340544e-02, -5.41015722e-02,
        -4.43551903e-02],
       [-1.74203202e-01,  2.16519262e-02, -9.84969261e-02,
        -2.12027665e-02, -2.21216242e-03, -1.05703498e-02,
         1.97316750e-01, -5.01735212e-02, -5.89581687e-02,
        -3.75276472e-02],
       [-1.72347445e-01,  7.31023666e-03, -6.90483030e-02,
        -1.64862647e-02, -1.14455215e-01,  2.19900207e-02,
         1.35448132e-01, -1.00226626e-01, -7.59772917e-02,
         6.38809720e-02],
       [ 1.80513574e-01, -2.18910771e-01, -1.38895680e-02,
         1.43884298e-01, -1.62710167e-01, -1.15585286e-01,
         7.52916096e-02, -2.68293940e-02, -6.32286799e-02,
        -1.23605541e-02],
       [-1.71649790e-01, -4.07447089e-02, -3.61492106e-02,
        -1.01750962e-01,  1.45666616e-02,  1.34261997e-01,
         1.71101252e-01, -9.25994759e-02, -2.70847015e-01,
         3.86883175e-02],
       [-1.80120489e-01, -4.46615192e-02, -6.52947987e-02,
         6.09544624e-03, -1.10099171e-01, -5.99000660e-03,
         1.42659475e-01, -3.92472727e-02, -1.44287782e-01,
         1.47078865e-01],
       [-1.78235886e-01,  1.29826074e-02, -8.78775528e-02,
         2.32509915e-02, -1.54450345e-02, -3.34829670e-02,
         1.99844361e-01, -3.98525466e-02, -1.62839318e-01,
         2.01819571e-01],
       [-1.70733268e-01, -4.67869039e-02, -8.13670607e-02,
         6.12430555e-03, -6.71784290e-02, -8.32929580e-02,
         1.92140209e-01, -5.84879160e-02, -1.49876103e-02,
         1.27372680e-01],
       [-1.55708264e-01,  5.21964576e-02, -1.42869788e-01,
         3.65244448e-02,  2.37583280e-02, -5.58513634e-02,
         1.55989614e-01, -2.70579795e-02, -2.43501482e-03,
         8.40171231e-02],
       [-1.56692818e-01,  4.54332211e-02, -1.42395394e-01,
         1.18188458e-02,  4.70012341e-02, -3.18111721e-02,
         1.05684225e-01,  2.47128519e-02,  8.83297112e-02,
         3.10567579e-02],
       [-1.64952894e-01,  3.65964126e-02, -1.40036501e-01,
         5.19127445e-02, -1.43850761e-03, -8.83083232e-02,
         8.70290893e-02, -3.02945549e-02,  5.83169614e-02,
        -1.48122023e-01],
       [-1.62814532e-01,  4.52989565e-02, -1.44433738e-01,
         5.40509176e-02, -1.96280020e-02, -1.16652872e-01,
         1.48574191e-01,  3.55865973e-02,  8.57643360e-02,
        -1.46797690e-01],
       [-1.71281165e-01, -3.46753998e-03, -1.08748688e-01,
         8.69666306e-02, -3.39219276e-02, -6.65160591e-02,
         8.28601851e-02,  5.40891873e-02,  7.54512413e-02,
        -1.17178848e-01],
       [-1.78643989e-01, -8.99685319e-03, -1.09106261e-01,
         1.34245158e-02,  5.11048631e-02, -8.79082525e-02,
        -4.86048762e-02,  8.40294259e-02,  6.24496969e-02,
        -9.14684999e-02],
       [-1.71482663e-01, -4.70808916e-02, -6.43619357e-02,
         4.04533016e-02, -1.53628442e-02, -6.99331785e-02,
        -1.87565638e-02,  5.43546712e-02,  1.14487321e-01,
        -2.30930014e-01],
       [-1.72723659e-01, -4.60479712e-02, -6.59248576e-02,
         4.59256660e-02, -6.22025442e-02, -1.16782179e-01,
        -1.47121682e-02,  2.78405541e-03,  6.92402991e-02,
        -1.48975237e-01],
       [-1.70490771e-01, -4.06996570e-02, -7.31989531e-02,
        -7.33057540e-03, -5.35392177e-02, -1.49023158e-01,
        -9.50104718e-02,  8.75615178e-02,  7.04118335e-02,
        -9.81264658e-02],
       [-1.77044783e-01, -4.37523962e-02, -7.49156010e-02,
        -1.19017243e-02, -9.01476870e-02, -1.57176986e-01,
        -2.06080957e-01,  5.42776474e-02, -4.80680383e-03,
         1.45830993e-02],
       [-1.78868343e-01, -5.34430654e-02, -7.29617665e-02,
        -1.92068268e-02, -2.20344938e-02, -1.39028539e-01,
        -2.09163022e-01,  6.54752752e-02, -4.61833058e-02,
         9.71167208e-02],
       [-1.69816199e-01, -5.16469576e-02, -8.01953742e-02,
        -3.56231362e-02, -6.32760960e-02, -1.45296435e-01,
        -2.75290558e-01,  3.57896259e-02, -6.82898840e-02,
         3.23169362e-02],
       [-1.72251781e-01, -5.33853733e-02, -8.06432978e-02,
        -4.06573888e-02, -6.12017004e-02, -1.00380205e-01,
        -2.44447849e-01,  9.12264685e-02, -8.29856971e-02,
         1.05273781e-01],
       [-1.67302842e-01, -1.02447740e-01, -4.16651939e-02,
        -6.06273991e-02, -9.19834268e-02, -7.78598772e-02,
        -1.59675375e-01,  6.41916841e-02, -1.53869228e-02,
         1.05319924e-02],
       [ 1.28697036e-02, -1.75159009e-01, -2.34063885e-02,
         7.77217500e-02, -1.14007669e-02, -1.26107370e-01,
        -4.09922975e-02,  8.91650399e-02, -1.60819866e-02,
         1.24569768e-01],
       [-3.73656779e-03, -2.05045307e-01,  7.30430030e-03,
        -1.27485746e-02,  2.60610924e-02, -4.95894276e-02,
        -7.20649413e-02,  7.30952854e-02,  1.28717166e-02,
        -1.06126794e-01],
       [ 5.55033601e-03, -1.75748590e-01, -4.87063183e-03,
         2.35173917e-02,  1.08996870e-01, -1.36307455e-01,
        -3.17030882e-02,  1.27450281e-01,  6.11924298e-02,
         8.80780386e-02],
       [ 7.79036820e-03, -2.08217670e-01, -7.98781594e-03,
         2.90683216e-02,  3.97051650e-02, -1.71810983e-03,
         5.80120711e-02,  2.61858992e-01, -4.03516450e-02,
         6.06584302e-02],
       [ 9.74984265e-03, -2.06036844e-01, -4.97373234e-03,
         6.40191568e-02,  3.97206088e-03, -1.08008263e-02,
         6.16558306e-02,  1.08764831e-01, -7.99784996e-02,
        -9.68995291e-02],
       [ 4.07183802e-03, -1.82071671e-01, -1.04208633e-02,
        -6.86725411e-03,  1.04264341e-01, -5.47661660e-02,
        -7.35259176e-02,  4.44830137e-02, -1.25969775e-03,
        -6.72096807e-02],
       [ 4.23013911e-03, -1.81072972e-01, -1.55302560e-02,
         3.96095324e-02,  9.05997300e-02,  2.94278647e-02,
        -5.44209709e-02,  7.16826296e-02, -1.01303260e-01,
        -1.28192583e-01],
       [ 1.54332670e-02, -1.81955721e-01, -1.35209632e-02,
         7.04359468e-02,  6.44139447e-02, -6.79784787e-02,
         2.36025408e-02,  1.15284902e-01, -8.10019040e-02,
        -1.39438307e-01],
       [ 1.00597093e-02, -2.07948128e-01,  2.59642195e-02,
         3.92634136e-02,  1.11957618e-01, -6.25054490e-02,
         2.31602632e-02,  1.58034215e-03, -1.27458796e-01,
        -6.97070208e-03]]

media_actitudes = [5.37674838, 5.35809896, 5.3126786 , 5.28214769, 4.71529553, 4.68566702, 4.6766431 , 4.71409234, 4.6772447 , 4.63723868, 3.53827643, 2.92058956, 2.85982855, 3.65814408, 3.69138216, 4.06828094, 4.14483381, 4.15536171, 4.16228004, 4.05790344, 4.1765679 , 3.95397804, 4.27628215, 3.97774101, 4.20243646, 4.26274628, 4.32200331, 4.26620544, 4.27507896, 4.17822229, 4.27432697, 4.20093247, 4.19220935, 4.02135659, 4.10136863, 4.14693939, 3.99894721, 2.99518725, 2.9058505 , 2.85471499, 2.87592119, 2.90976087, 2.91607761, 3.07474808, 3.13881787, 5.10663258, 5.48699052, 5.57572567, 5.58159122, 3.70160926, 5.54985712, 5.64024665, 5.63408031, 5.66160325, 5.59617988, 5.56429538, 5.57106332, 5.57662806, 5.62159723, 5.59903745, 5.64957136, 5.68220785, 5.66190405, 5.63362912, 5.63979546, 5.63663709, 5.66220484, 5.69168296, 4.30741465, 4.34441269, 4.30530907, 4.37118364, 4.35734697, 4.28455407, 4.32967364, 4.34215672, 4.37780117]
estandar_actitudes = [1.27146109, 1.23966039, 1.25836199, 1.28624883, 1.30548081, 1.29964843, 1.31150047, 1.29955847, 1.30463438, 1.37446082, 1.79476897, 1.54573631, 1.47875856, 1.86881598, 1.88782582, 2.00821869, 1.98238046, 1.94642871, 1.91963616, 1.96075773, 2.00475928, 1.9224557 , 1.96744984, 1.92162568, 2.01302619, 1.94957423, 1.98624902, 1.96444082, 1.9544251 , 1.90697492, 1.94554428, 1.92400576, 1.91847831, 1.91284873, 1.88690774, 1.89103911, 1.90773146, 1.61455129, 1.67110101, 1.65657238, 1.66395545, 1.67590056, 1.68053069, 1.63510352, 1.67118241, 1.66516467, 1.25045868, 1.22327767, 1.21809381, 1.83543773, 1.24905032, 1.16968001, 1.14834662, 1.12958567, 1.21108144, 1.19960155, 1.2183831 , 1.22739537, 1.17880517, 1.19308035, 1.1555796 , 1.16942504, 1.15795009, 1.19701296, 1.17204644, 1.18352835, 1.17300873, 1.18770464, 1.96974882, 1.97026997, 1.94641756, 2.00059854, 1.9900831 , 1.97866264, 1.97439062, 1.9600628 , 1.99242562]
    
    # Se le resta la media
usuario_actitudes = (usuario_actitudes -  media_actitudes)/estandar_actitudes

actitudes_ideal = 9.85
Act = pd.DataFrame([4.886479, 4.820008, 4.883331, 4.797048, 4.771941, 4.86577, 4.753092, 4.774559, 4.737989, 4.73154])
Act.columns= ['Ideal']

usuario_puntuacion_actitudes = np.matmul(usuario_actitudes, Table10_matrix)
    
usuario_puntuacion_actitudes=usuario_puntuacion_actitudes[0]

#usuario_puntuacion_actitudes[0] = min(4*np.exp(0.25*usuario_puntuacion_actitudes[0])/(np.exp(0.25*usuario_puntuacion_actitudes[0])+1)+1,0.9*4.88)
usuario_puntuacion_actitudes[0] = 4*np.exp(usuario_puntuacion_actitudes[0])/(np.exp(usuario_puntuacion_actitudes[0])+1)+1

#usuario_puntuacion_actitudes[1] = min(1.27*(4*np.exp(usuario_puntuacion_actitudes[1])/(np.exp(usuario_puntuacion_actitudes[1])+1)+1),0.9*4.82)
usuario_puntuacion_actitudes[1] = 4*np.exp(usuario_puntuacion_actitudes[1])/(np.exp(usuario_puntuacion_actitudes[1])+1)+1

#usuario_puntuacion_actitudes[2] = min(1.27*(4*np.exp(usuario_puntuacion_actitudes[2])/(np.exp(usuario_puntuacion_actitudes[2])+1)+1),0.9*4.88)
usuario_puntuacion_actitudes[2] = 4*np.exp(usuario_puntuacion_actitudes[2])/(np.exp(usuario_puntuacion_actitudes[2])+1)+1

#usuario_puntuacion_actitudes[3] = min(4*np.exp(usuario_puntuacion_actitudes[3])/(np.exp(usuario_puntuacion_actitudes[3])+1)+1,0.9*4.79)
usuario_puntuacion_actitudes[3] = 4*np.exp(usuario_puntuacion_actitudes[3])/(np.exp(usuario_puntuacion_actitudes[3])+1)+1

#usuario_puntuacion_actitudes[4] = min(4*np.exp(usuario_puntuacion_actitudes[4])/(np.exp(usuario_puntuacion_actitudes[4])+1)+1,0.9*4.77)
usuario_puntuacion_actitudes[4] = 4*np.exp(usuario_puntuacion_actitudes[4])/(np.exp(usuario_puntuacion_actitudes[4])+1)+1

#usuario_puntuacion_actitudes[5] = min(4*np.exp(usuario_puntuacion_actitudes[5])/(np.exp(usuario_puntuacion_actitudes[5])+1)+1,0.9*4.86)
usuario_puntuacion_actitudes[5] = 4*np.exp(usuario_puntuacion_actitudes[5])/(np.exp(usuario_puntuacion_actitudes[5])+1)+1

#usuario_puntuacion_actitudes[6] = min(4*np.exp(usuario_puntuacion_actitudes[6])/(np.exp(usuario_puntuacion_actitudes[6])+1)+1,0.9*4.75)
usuario_puntuacion_actitudes[6] = 4*np.exp(usuario_puntuacion_actitudes[6])/(np.exp(usuario_puntuacion_actitudes[6])+1)+1

#usuario_puntuacion_actitudes[7] = min(4*np.exp(usuario_puntuacion_actitudes[7])/(np.exp(usuario_puntuacion_actitudes[7])+1)+1,0.9*4.77)
usuario_puntuacion_actitudes[7] = 4*np.exp(usuario_puntuacion_actitudes[7])/(np.exp(usuario_puntuacion_actitudes[7])+1)+1

#usuario_puntuacion_actitudes[8] = min(4*np.exp(usuario_puntuacion_actitudes[8])/(np.exp(usuario_puntuacion_actitudes[8])+1)+1,0.9*4.73)
usuario_puntuacion_actitudes[8] = 4*np.exp(usuario_puntuacion_actitudes[8])/(np.exp(usuario_puntuacion_actitudes[8])+1)+1

#usuario_puntuacion_actitudes[9] = min(4*np.exp(usuario_puntuacion_actitudes[9])/(np.exp(usuario_puntuacion_actitudes[9])+1)+1,0.9*4.73)
usuario_puntuacion_actitudes[9] = 4*np.exp(usuario_puntuacion_actitudes[9])/(np.exp(usuario_puntuacion_actitudes[9])+1)+1

usuario_actitudes_scoring    = 2*usuario_puntuacion_actitudes.mean()


Act['Usuario'] = pd.DataFrame(usuario_puntuacion_actitudes.transpose())
Act.index = ['Inconformidad e individualismo','Locus de control interno ','Tendencia a asumir riesgos ',
               'Tolerancia al fracaso y a la incertidumbre ','Motivación','Persistencia ','Legitimidad','Autoeficacia ','Competitividad','Confianza ']

# Concatenar las dos Dataframes (Conocimiento, Habilidades, y Actitudes y valores)
Ideal  = Ideal.append(Act)

# Imprimir los resultados de la dimension Habilidades
output_file.write(f"Actitudes_y_Valores:{round(usuario_actitudes_scoring,2)}")

output_file.write(f"\n")
output_file.write(f"Ideal_Ac_Val:{round(actitudes_ideal,2)}")
output_file.write(f"\n")

# Imprimir el valor Global
Global = 10*(usuario_conocimiento_scoring+usuario_habilidades_scoring+10*usuario_actitudes_scoring)/12
#Global = 50*(Global - 51.7743675179597)/(80.3937217860003-51.7743675179597)+48
output_file.write(f"Global:{round(Global,2)}")
output_file.write(f"\n")
output_file.close()
# Imprimir los ideales de los atributos
#Ideal = Ideal.sort_values(by='Usuario', ascending=False)
Ideal.to_csv(f"{path}/files/{usuario_csv}_output.csv",mode='a', header=False)
