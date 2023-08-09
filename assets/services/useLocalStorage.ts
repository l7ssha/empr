export const useLocalStorage = () => {
  const setItem = (key: string, value: string | null) => {
    localStorage.setItem(key, value);
  };

  const getItem = (key: string): string | null => {
    return localStorage.getItem(key);
  };

  const removeItem = (key: string) => {
    localStorage.removeItem(key);
  };

  return { setItem, getItem, removeItem };
};
