import requests
import pandas as pd

PERIOD = "201808"
TOP_ARTISTS_URL = f"https://api.vagalume.com.br/rank.php?apikey=660a4395f992ff67786584e238f501aa&type=art&periodVal={PERIOD}8&scope=nacional&limit=1000"

response = requests.get(TOP_ARTISTS_URL)
resp_json = response.json()

artists_json = resp_json["art"]["month"]["nacional"]
artists_df = pd.DataFrame.from_dict(artists_json)

artists_df.to_csv("artists.csv")