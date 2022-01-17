import numpy as np
import pandas as pd

Questions_109 = open('piazza_questions_cse109.txt', encoding='utf8')
Questions_109 = pd.read_csv('piazza_questions_cse109.txt', sep='|')
print(Questions_109.iloc[0])