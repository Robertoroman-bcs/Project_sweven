El Dashboard que se usa en el proyecto es la version AdminLTE-3.2.0

//Pasos para subir nuevos cambios al repositorio:
1.- git status
2.- git add .
3.- git commit -m "Descripción de los cambios"
4.- git push origin main

//Eliminacion de archivos pdf se hace uso de el archivo .gitignore
Primero se crea:
- touch .gitignore
Dentro del archivo escribimos el siguiente script, el cual borrara o evitara que se suban estos archivos pdf que esten en esta ruta:
- src/Document/*.pdf
Ejecutamos el siguiente comando para eliminar los archivos que ya esten en el respositorio:
- git rm --cached src/Document/*.pdf
Agremos al archivo para subirlo al repositorio:
- git add .gitignore
Ejecutamos el sig comando para que se suba el archvivo al repositorio:
- git commit -m "Subida sin archivos pdf"
