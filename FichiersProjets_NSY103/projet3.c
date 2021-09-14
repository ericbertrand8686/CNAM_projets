/*******************************************************************/
/* Projet 3                                                        */
/* Creation des processus père et fils                             */
/* Envoi d'un message du fils au père par protocole UDP            */
/*******************************************************************/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <pthread.h>
#include "biblio.h"

main() {
    int pere;
    int fils;
    pere = getpid();
    printf ("<PID %d > : Je suis le père\n", pere);
    // Création de processus
    fils = fork();
    // PERE
    if (fils != 0) {
        printf ("<PID %d > : Je viens de créer le fils PID %d\n", pere, fils);
        char messageRec[100];
        int rec = reception(8000, messageRec);
        if (rec!=0) {
            printf ("<PID %d > : Faute en réception du message\n", pere);
            exit(rec);
        } else {
            printf ("<PID %d > : Message reçu du fils : %s\n", pere, messageRec);
            exit(0);
        }
    }

    // FILS
    else {
        char message[100];
        int moi = getpid();

        printf("<PID %d > : Je suis le fils\n", moi);
        printf("<PID %d > : Veuillez saisir un message\n", moi);
        fgets (message,100,stdin);
        message[strcspn(message, "\r\n")] = 0;

        int env = emission("127.0.0.1", 8000, message);
                if (env!=0) {
            printf ("<PID %d > : Faute dans l'envoi du message\n", moi);
            exit(env);
        } else {
            printf ("<PID %d > :  Message envoyé au père \n", moi);
            exit(0);
        }
    }
}