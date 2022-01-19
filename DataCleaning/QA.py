import numpy as np
import pandas as pd

Questions_109 = pd.read_csv('piazza_questions_cse109.txt', sep='|',header=None)
Questions_109.columns=["ID","Problem","Subject","Error","Answer","pid"]
Questions_109.to_csv('QA109.csv')