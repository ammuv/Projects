# Simple Distributed Blockchain
A simplified distributed blockchain developed by implementing multi-threaded socket programs in Python.

In order to acheive data consistency, first the clocks in each client are synchronized using a time server that returns the UTC and Christian's algorithm.

Then a simple distributed protocol is used to communicate transactions amongst all clients.
