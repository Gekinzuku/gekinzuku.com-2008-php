// Pong DS
// Created by GeekyLink: Created on May 26, 2007
// Code 'cleaned' by Ice1605 sometime in July
// Copyright 2007
// I am provided this code for personal use only
// You may learn from this code and have fun playing the game
// But you may not sell or make money in any way off this code
// Although that seems completely unnessary, you'd be suprised what some jerks will do for easy money
// This code is much improved over the original; the original was heavily based off a starfield similutar
// but few traces of that exist now, main thing this code lacks is comments, so feel free to use it to learn 
// from this code, but it will require a little patience, cause I was too lazy to add more comments LOL
// Thank you, and please have fun with this :P

#include <nds.h>
#include <stdlib.h>
#include <stdio.h>
 

int iPaddle; //where the paddle 1 is
int iPaddle2; // where the paddle 2 is
int iBallDireX; //Horizontal direction of the ball 0 = left 1 = right
int iBallDireY; //Vertical direction of the ball 0 = up 1 = down

int iScore1 = 0; // score of player 1
int iScore2 = 0; // score of player 2

int iSize1 = 50; //size of the first paddle
int iSize2 = 50; //size of the second paddle

char cGame; //n is normal, c is crazy
 
typedef struct 
{
	int x;
	int y;
	int speed;
	unsigned short color;
 
}Ball;
Ball iball;

void MoveBall(Ball* ball);
void HowToMove(Ball* ball);
void ClearScreen();
void InitBall();
void DrawBall(Ball* ball);
void EraseBall(Ball* ball);
void Paddle();
void Paddle2();
void erasepaddle();
void getgameready();
void setgametype();
bool Score();

int main() 
{
	bool bPause = true; //used to pause the game and such
	bool bGameOver = false; //used for gameover, amazing concept

	getgameready();

	//title screen
	printf("           Pong DS\n\n\n\n\n\n\n\n\n\n\n\n\n");
	printf("   Programmed by GeekyLink\n");
	printf("  Code 'cleaned' by Ice1605\n");
	printf("  Improved again by GeekyLink\n");
	printf("         Copyright 2007\n\n\n\n");
	printf("      Press start to begin");
	//press start to begin the game
	while (bPause == true)
	{
		scanKeys();
		if (keysDown() & KEY_START)
			bPause = false;
	}

	setgametype();

	//the infinite game loop
	while(1)
	{
		swiWaitForVBlank();
		bGameOver = Score();
		if (bGameOver == false)//checks for game over
		{
			if (bPause == false)//checks for game paused
			{	
				EraseBall(&iball);
				MoveBall(&iball);
				DrawBall(&iball);
				HowToMove(&iball);
				erasepaddle();
				Paddle();
				Paddle2();	
			}
			else
			{
				printf("\n\n\n\n\n\n\n\n\n\n\n\n           Game Paused"); //says the game is paused
			}
		
			scanKeys();

			//if you press start the game will pause/unpause
			if (keysDown() & KEY_START)
			{
				if(bPause == true)
					bPause = false;
				else
					bPause = true;
			}
		}
		else //if the game is over
		{
			printf("\n\n\n\n\n\n\n\n\n\n\n\n           Game Over"); //says game over
			scanKeys();
			//if start is pressed the game will start back up new
			if (keysDown() & KEY_START)
			{
				bGameOver = false;
				getgameready(); //prepares game
			}
		}
	}
 
	return 0;
}
void setgametype()
{
	bool bPause = true;
	consoleClear(); //clears screen
	printf("          Set game mode\n");
	printf("            -> Normal\n");
	printf("            <- Crazy\n");
	while (bPause == true)
	{
		scanKeys();
		if (keysDown() & KEY_LEFT)
		{
			bPause = false;
			cGame = 'c';
		}
		else if (keysDown() & KEY_RIGHT)
		{
			bPause = false;
			cGame = 'n';
		}
	}
}
void getgameready()
{
	bool bPause;
	bool bGameOver;

	//varibles
	iPaddle = 50;
	iPaddle2 = 50;

	iScore1 = 0;
	iScore2 = 0;

	iBallDireX = 1;
	bPause = false;
	bGameOver = false;


	//random DS functions
	consoleDemoInit();

	irqInit();
	irqEnable(IRQ_VBLANK);
 
	videoSetMode(MODE_FB0);
	vramSetBankA(VRAM_A_LCD);
 
	//gets the game ready
    ClearScreen();
	InitBall();
 
	//I like infinite loops
}

void MoveBall(Ball* ball)
{
	//moves left and right
	if (iBallDireX == 1) { //if the ball is moving right
		ball->x += ball->speed; // move right
	}
	else { //if the ball is moving left
		ball->x -= ball->speed; //move left
	}

	//moves up and down
	if (iBallDireY == 1) { //if the ball is moving down
		ball->y += ball->speed; // move down
	}
	else { //if the ball is moving up
		ball->y -= ball->speed; //move up
	}
}

void HowToMove(Ball* ball)
{

	//detremines left and right
	if(ball->x >= 250)
	{ //if ball is at the right side of the screen
		if (iPaddle <= ball->y)
		{
			if (iPaddle + iSize1 >= ball->y)
			{
				iBallDireX = 0; //sets ball to move right
			}
			else 
			{
				VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = RGB15(0,0,0);
				ball->x = 10;
				iScore1 ++;
				if (cGame == 'c')
				{	
					erasepaddle();
					iSize1 += 5;
					iSize2 -= 5;
				}
			}	
		}
		else 
		{
			VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = RGB15(0,0,0);
			ball->x = 10;
			iScore1 ++;
			if (cGame == 'c')
			{	
				erasepaddle();
				iSize1 += 5;
				iSize2 -= 5;
			}
		}
	}

	if(ball->x <= 6){ //if the ball is at the left side of the screen
		
		if (iPaddle2 <= ball->y){
			if (iPaddle2 + iSize2 >= ball->y){
				iBallDireX = 1; //sets ball to move right
			}
			else {
				VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = RGB15(0,0,0);
				ball->x = 250;
				iScore2 ++;
				if (cGame == 'c')
				{	
					erasepaddle();
					iSize2 += 5;
					iSize1 -= 5;
				}
			}	
		}
		else {
			VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = RGB15(0,0,0);
			ball->x = 250;
			iScore2 ++;
			if (cGame == 'c')
			{	
				erasepaddle();
				iSize2 += 5;
				iSize1 -= 5;
			}
		}
	}

	//detremines up and down
	if(ball->y >= 192){ //if ball is at the bottom of the screen
		iBallDireY = 0; //sets ball to move up
	}

	if(ball->y <= 0){ //if the ball is at the top of the screen
		iBallDireY = 1; //sets ball to move down
	}
}
void ClearScreen()
{
     int i;
     
     for(i = 0; i < 256 * 192; i++)
           VRAM_A[i] = RGB15(0,0,0);
}
void InitBall()
{
		iball.color = RGB15(31,31,31);
		iball.x = 10;
		iball.y = 75;
		iball.speed = 2;
}
void DrawBall(Ball* ball)
{
	VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = ball->color;
} 
void EraseBall(Ball* ball)
{
	VRAM_A[ball->x + ball->y * SCREEN_WIDTH] = RGB15(0,0,0);
}

void Paddle()
{
	int i;
	int iLength;

	if(REG_KEYINPUT & KEY_B)
	{
		iPaddle = iPaddle;
	}
	else
	{

		iPaddle --;
	}

	if(REG_KEYINPUT & KEY_A)
	{
		iPaddle = iPaddle;
	}
	else
	{
	
		iPaddle ++;
	}

	iLength = iPaddle;


	for(i = 0; i < iSize1; i++)
	{
		VRAM_A[250 + iLength * 256] = RGB15(31,31,31);
		iLength = iLength + 1;
	}

	return;

}

void Paddle2()
{
	int i;
	int iLength;

	if(REG_KEYINPUT & KEY_UP)
	{
		iPaddle2 = iPaddle2;
	}
	else
	{

		iPaddle2 --;
	}

	if(REG_KEYINPUT & KEY_DOWN)
	{
		iPaddle2 = iPaddle2;
	}
	else
	{
	
		iPaddle2 ++;
	}

	iLength = iPaddle2;


	for(i = 0; i < iSize2; i++)
	{
		VRAM_A[6 + iLength * 256] = RGB15(31,31,31);
		iLength = iLength + 1;
	}

	return;

}

void erasepaddle()
{
	int i;
	int iLength;

	//erase paddle 2
	iLength = iPaddle2;

	for(i = 0; i < iSize2; i++)
	{
		VRAM_A[6 + iLength * 256] = RGB15(0,0,0);
		iLength = iLength + 1;
	}	


	for(i = 0; i < iSize2; i++)
	{
		VRAM_A[6 + iLength * 256] = RGB15(0,0,0);
		iLength = iLength - 1;
	}

	//erase paddle 1

		iLength = iPaddle;

	for(i = 0; i < iSize1; i++)
	{
		VRAM_A[250 + iLength * 256] = RGB15(0,0,0);
		iLength = iLength + 1;
	}	


	for(i = 0; i < iSize1; i++)
	{
		VRAM_A[250 + iLength * 256] = RGB15(0,0,0);
		iLength = iLength - 1;
	}

}
bool Score()
{
	consoleClear(); //clears screen
	printf("     Player One's score: %d \n", iScore1); 
	printf("     Player Two's score: %d \n", iScore2);

	if ((iScore1 == 10) || (iScore2 == 10)) //if someone got 10 points than game over
		return true;
	else
		return false;
}