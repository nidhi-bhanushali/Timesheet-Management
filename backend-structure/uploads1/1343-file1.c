#include<stdio.h>
void main()
{
    char toDo[50];
    int i , n ;
    FILE *fp;
    fp = fopen("file1.txt", "w+");/*  open for writing */
    if (fp == NULL)
        {
        printf("File does not exists \n");
        return;
    }
    printf("Enter the number of ToDos for the day\n");
    scanf("%d",&n);
    printf("Enter the toDos for the day\n");
    for(i=0;i<=n;i++)
    {
        gets(toDo);
        fprintf(fp, "toDo= %s\n", toDo);
    }


}
