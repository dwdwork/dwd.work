#include <stdio.h>
int main() {
    int testInteger = 6;
    float testFloat = 13.5;
    double testDouble = 12.4;
    char testChar = 'a';
    int testEnter;

    printf("Number = %d \n", testInteger);
    printf("Float = %f \n", testFloat);
    printf("Double = %lf \n", testDouble);
    printf("Character = %c \n", testChar); 
    printf("Enter an integer: ");
    scanf("%d", &testEnter); 
    printf("Number = %d", testEnter);
    
   return 0;
}
