from flask import Flask, render_template
from chess_engine import *
import chess
from typing import List
from random import choice
from werkzeug.middleware.proxy_fix import ProxyFix


app = Flask(__name__)
app.wsgi_app = ProxyFix(app.wsgi_app,x_for=1,x_host=1,x_prefix=1)

@app.route('/')
def index():
    return render_template("index.html")

def pre_calc_knight_path(secret: str = "FLOORBACKVILE") -> List[chess.Move]:
    fake_board = chess.Board()
    START = chess.parse_square("b8")
    PATH = []

    for char in secret:
        # Store where we are currently
        PATH.append(START)
        
        # for each character we will move the knight
        fake_board.turn = chess.BLACK
        possible_moves = list(
            filter(
                lambda x: x.uci().startswith(chess.square_name(START)),
                list(fake_board.legal_moves)
            )
        )


        # Remove any moves that have been seen 
        filtered_possible_moves = list(filter(lambda x: x.to_square not in PATH, possible_moves))


        if len(filtered_possible_moves) > 0:
            random_choice = filtered_possible_moves[0].uci() #choice(filtered_possible_moves).uci()
            fake_board.push_uci(
                random_choice
            )

            START = chess.parse_square(random_choice[-2:])
        else:
            break

    assert len(PATH) == len(secret)

    return PATH

def move_along_knights_path(fen: str):
    board = chess.Board()
    board.set_fen(fen)

    knight_path = pre_calc_knight_path()
    print(f"{knight_path = }")

    for idx, spot in enumerate(knight_path):
        print(f"{idx = } {spot = }")
        piece = board.piece_at(spot)

        if piece and piece == chess.Piece.from_symbol('n') and len(knight_path) > (idx + 1):
            print(f"[-] Found Knight at {chess.square_name(spot)}. Our next move is {chess.square_name(knight_path[idx + 1])}")
            move = chess.Move(spot, knight_path[idx + 1])
            break
    else:
        raise Exception("Cannot move along path!")
    
    return move.uci()
    

@app.route('/move/<int:depth>/<path:fen>/')
def get_move(depth, fen):
    print(depth)
    print("Calculating...")
    try:
        move = move_along_knights_path(fen)
    except:
        print(f"Either we are done moving or the path was broke!")
        engine = Engine(fen)
        move = engine.iterative_deepening(depth - 1)
    print("Move found!", move)
    print()
    return move


@app.route('/test/<string:tester>')
def test_get(tester):
    return tester


if __name__ == '__main__':
    app.run(debug=False, host="0.0.0.0")
