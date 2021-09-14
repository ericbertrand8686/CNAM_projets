/*******************************************************************/
/* Projet                                                          */
/* Etape 1 : communication entre thread principal et secondaire    */
/* Etape 2 : synchronisation père et fils                          */
/*******************************************************************/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <pthread.h>

char message[100];
int flag = 0;

/***********************************/
/* THREAD SECONDAIRE */
/***********************************/
static void *code_thread_sec (void* arg) {

    pthread_t pthrmoi;  // identification Posix du thread
    pthrmoi = pthread_self();
    
    while(1) {
        if (flag==1) {
            printf( "<thread : %u > : <message : %s >\n", (unsigned int)pthrmoi, message);
            flag=0;
        }
    } // Boucle sans Fin
}

/***********************************/
/* PROCESSUS ET THREAD PRINCIPAL   */
/***********************************/
int main() {

    pthread_t pthrmain, pthrsec;
    pthrmain = pthread_self();

    // Creation du thread secondaire
    if (pthread_create(&pthrsec, NULL,&code_thread_sec, NULL) != 0)
        printf( "\nJe suis le thread principal Posix %u, faute lancement du thread secondaire\n\n", (unsigned int)pthrmain);
    else printf( "\nJe suis le thread principal Posix %u et j'ai lancé le thread secondaire Posix %u \n\n", (unsigned int)pthrmain, (unsigned int)pthrsec);

    while(1) {
        if (flag==0) {
                printf("<thread : %u > : Veuillez saisir un message\n", (unsigned int)pthrmain);
                fgets (message,100,stdin);
                message[strcspn(message, "\r\n")] = 0; // On tronque le message au niveau du passage à la ligne
            flag=1;
        }
    }
}
